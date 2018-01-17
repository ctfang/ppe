<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/12/20
 * Time: 14:37
 */

namespace Apps\Console\Commands\Queue;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class StopCommand extends Command
{
    protected function configure()
    {
        $this->setName('queue:stop')
            ->setDescription('停止队列[QUIT、USR1、USR2、CONT]')
            ->addOption('sigspec',null,InputOption::VALUE_OPTIONAL,'退出信号');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $sigspec = $input->getOption('sigspec');
        if( $GLOBALS['argv'][0]!=realpath($GLOBALS['argv'][0]) ){
            // 执行加上路径，用来区别多个项目
            $GLOBALS['argv'][0] = realpath($GLOBALS['argv'][0]);
        }
        $commandPath = $GLOBALS['argv'][0];
        exec('ps -ax -o pid -o cmd|grep "'.$commandPath.' queue:start"',$arr);
        foreach ($arr as $str){
            $arr = explode(' ',trim($str));
            if( isset($arr[1]) && strpos($arr[1],'php')!==false ){
                $pid = $arr[0];
                $sig = $sigspec?' -'.$sigspec:' -9';
                $kill = "kill{$sig} {$pid}";
                exec($kill);
                $output->writeln("<info>{$kill}</info>");
            }
        }
    }
}