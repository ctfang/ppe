<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/12/20
 * Time: 14:27
 */

namespace Apps\Console\Commands\Queue;


use Resque;
use Resque_Worker;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class StartCommand extends Command
{
    protected function configure()
    {
        $this->setName('queue:start')
            ->setDescription('启动队列')
            ->addOption('group', null,InputOption::VALUE_OPTIONAL, '队列分组名称', '*');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if( $GLOBALS['argv'][0]!=realpath($GLOBALS['argv'][0]) ){
            // 执行加上路径，用来区别多个项目
            $GLOBALS['argv'][0] = realpath($GLOBALS['argv'][0]);
            $cmd = implode(' ',$GLOBALS['argv']);
            passthru("php {$cmd}");
            exit(0);
        }
        $group    = $input->getOption('group');
        $runGroup = [];
        if ($group == '*') {
            // 启动所有
            $runGroup = \Config::get('queue.group', []);
        } else {
            $config = \Config::get('queue.group.' . $group, []);
            if ($config) {
                $runGroup = [$config];
            } else {
                $output->writeln("<error>分组名称不在配置文件里</error>");
            }
        }
        $config = \Config::get('queue')->toArray();
        Resque::setBackend($config['redis_backend']);
        $countGroup = count($runGroup);
        foreach ($runGroup as $name=>$groupName) {
            $countGroup--;
            $countPid = $groupName['worker'];
            for ($i = 0; $i < $groupName['worker']; ++$i) {
                $pid = pcntl_fork();
                $countPid--;
                if ($pid == -1) {
                    die("Could not fork worker " . $i . "\n");
                } else if (!$pid) {
                    $queues = $groupName->queue_name->toArray();
                    $worker = new Resque_Worker($queues);
                    fwrite(STDOUT, '*** Starting worker ' . $worker . "\n");
                    if( $countGroup<=0 && $countPid<=0 ){
                        unset($countGroup,$countPid,$queues);
                        fwrite(STDOUT, "\n");
                        $output->writeln("<info>Press Ctrl+C to quit. Start success.</info>");
                    }
                    $worker->work( $groupName['interval'] );
                    exit(0);
                }
            }
        }
        exit(0);
    }
}