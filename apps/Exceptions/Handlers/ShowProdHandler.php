<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/11/29
 * Time: 16:33
 */

namespace Apps\Exceptions\Handlers;


use Phalcon\Di;
use Whoops\Handler\Handler;

/**
 * @package Apps\Exceptions\Handlers
 */
class ShowProdHandler extends Handler
{
    /**
     * @return int|null A handler may return nothing, or a Handler::HANDLE_* constant
     */
    public function handle()
    {
        //echo 'OK';
    }
}