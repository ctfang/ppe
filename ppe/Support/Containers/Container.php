<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/12/4
 * Time: 19:01
 */

namespace Framework\Support\Containers;


trait Container
{
    private static $_instance;

    public static function setFacades($_instance)
    {
        self::$_instance = $_instance;
    }

    public static function __callStatic($name, $arguments=[])
    {
        return call_user_func_array([self::$_instance,$name],$arguments);
    }

    public function __call($name, $arguments=[])
    {
        return call_user_func_array([self::$_instance,$name],$arguments);
    }

    public function __get($name)
    {
        return self::$_instance->name;
    }
}