<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/11/23
 * Time: 18:52
 */

namespace Apps\Console\Tasks;


use Framework\Support\Cli\Input;
use Phalcon\Cli\Task;

class MainTask extends Task
{
    public function main()
    {
        dd(Input::get('name'));
    }
}