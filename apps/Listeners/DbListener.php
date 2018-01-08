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
    public function beforeQuery($event, $connection)
    {
        $data = $connection->getsqlVariables();
        if( !empty($data) ){

            \Log::debug("\n".$connection->getSQLStatement()."\n".var_export($data,true));
        }else{
            \Log::debug($connection->getSQLStatement());
        }
    }
}