<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/11/22
 * Time: 21:06
 */

namespace Framework\Support\Cli\Commands;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ScheduleCommand extends Command
{
    private $console;

    public function __construct($console)
    {
        $this->console = $console;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName( $this->console )
            ->setDescription('定时任务调用')
            ->setHelp('定时任务调用');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // 不需要执行
    }
}