<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/12/5
 * Time: 20:14
 */

namespace Apps\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DemoCommand extends Command
{
    protected function configure()
    {
        $this->setName('demo')->setDescription('示范命令');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>this is demo </info>');
    }
}