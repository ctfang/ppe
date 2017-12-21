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
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class StartCommand extends Command
{
    protected function configure()
    {
        $this->setName('queue:start')
            ->setDescription('启动队列')
            ->addArgument('group', InputArgument::OPTIONAL, '队列分组名称', '*');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $group    = $input->getArgument('group');
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
        foreach ($runGroup as $groupName) {
            for ($i = 0; $i < $groupName['worker']; ++$i) {
                $pid = pcntl_fork();
                if ($pid == -1) {
                    die("Could not fork worker " . $i . "\n");
                } else if (!$pid) {
                    $queues = $groupName->queue_name->toArray();
                    $worker = new Resque_Worker($queues);
                    fwrite(STDOUT, '*** Starting worker ' . $worker . "\n");
                    $worker->work( $groupName['interval'] );
                    break;
                }
            }
        }

    }
}