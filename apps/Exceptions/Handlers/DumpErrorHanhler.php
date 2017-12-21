<?php
/**
 * Created by PhpStorm.
 * User: baichou
 * Date: 2017/12/21
 * Time: 18:51
 */

namespace Apps\Exceptions\Handlers;


use Framework\Support\Handler;

class DumpErrorHanhler extends Handler
{
    /**
     * @return int|null A handler may return nothing, or a Handler::HANDLE_* constant
     */
    public function handle()
    {
        dump($this->getException());
    }
}