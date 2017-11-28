<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/11/24
 * Time: 17:03
 */

namespace Framework\Support\Exception;


use Monolog\Logger;
use Phalcon\Di;
use Whoops\Handler\Handler;

class LoggerHandlerException extends Handler
{
    /**
     * @return Logger
     */
    private function getLogger()
    {
        return Di::getDefault()->getShared('logger');
    }
    /**
     * @return int|null A handler may return nothing, or a Handler::HANDLE_* constant
     */
    public function handle()
    {
        $exception     = $this->getException();
        $errorCode     = $exception->getCode();
        $logger        = $this->getLogger();
        $errorString   = $exception->getMessage()."\n[stacktrace]\n".$exception->getTraceAsString();
        switch ($errorCode) {
            case E_WARNING:
                $logger->warning($errorString);
                break;
            case E_NOTICE:
                $logger->notice($errorString);
                break;
            case E_ERROR:
                $logger->error($errorString);
                break;
            default :
                $logger->error($errorString);
                break;
        }
    }
}