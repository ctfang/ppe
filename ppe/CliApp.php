<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/10/20
 * Time: 16:00
 */

namespace Framework;


use Phalcon\Cli\Console;

class CliApp
{
    private $console;

    public function __construct($di)
    {
        $this->console = new Console($di);
    }

    /**
     * Handles a request
     */
    public function handle()
    {
        $argv      = $GLOBALS['argv'];
        unset($argv[0]);
        if( isset($argv[1])  ) {
            if ( IS_CRON ) {
                unset($argv[1]);
                if (isset($argv[2])) {
                    $arguments['task'] = $argv[2];
                    unset($argv[2]);
                }
                if (isset($argv[3])) {
                    $arguments['action'] = $argv[3];
                    unset($argv[3]);
                }
            }else{
                $arguments['task'] = $argv[1];
                if( isset($argv[2]) ){
                    $arguments['action'] = $argv[2];
                    unset($argv[2]);
                }
            }
        }

        $arguments['params'] = $argv??[];

        $this->console->handle($arguments);
        return $this;
    }

    public function getContent()
    {

    }
}