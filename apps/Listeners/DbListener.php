<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/12/15
 * Time: 19:58
 */

namespace Apps\Listeners;


use Framework\Support\Listeners\DatabaseListener;

class DbListener extends DatabaseListener
{
    /**
     * 在发送SQL到数据库前触发
     */
    public function beforeQuery()
    {

    }
}