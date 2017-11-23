<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/10/20
 * Time: 16:00
 */

namespace Framework;


use Framework\Core\CliCore;
use Framework\Support\Cli\Commands\ScheduleCommand;
use Framework\Support\Cli\Input;
use Phalcon\Cli\Console;
use Symfony\Component\Console\Application;

class CliApp
{
    private $di;
    private $console;

    public function __construct($di)
    {
        $this->di = $di;
        $this->console = new Console($this->di);
    }

    /**
     * Handles a request
     */
    public function handle()
    {
        $schedule = 'schedule';
        if( isset($GLOBALS['argv'][1]) && $schedule==$GLOBALS['argv'][1] ){
            // 如果是定时任务-则启用phalcon自带的cli应用
            $arguments['task']   = $GLOBALS['argv'][2] ?? 'main';
            $arguments['action'] = $GLOBALS['argv'][2] ?? 'main';

            (new Input())->init($GLOBALS['argv']);
            $this->console->handle($arguments);
        }else{
            $application = new Application();
            $application->add(new ScheduleCommand($schedule));
            // 为了模块一致性，手动调用CliCore
            $core = new CliCore();
            $core->registerAutoloaders( $this->di );
            $core->registerServices( $this->di );
            $application->run();
        }
        return $this;
    }


    public function registerModules(array $arrModules)
    {
        return $this->console->registerModules($arrModules);
    }

    public function getContent()
    {
        echo "\n";
    }
}