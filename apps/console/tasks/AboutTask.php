<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/10/20
 * Time: 16:45
 */

namespace Apps\Console\Tasks;


use Phalcon\Cli\Task;

class AboutTask extends Task
{
    public function main()
    {
        echo __LINE__;
    }
}