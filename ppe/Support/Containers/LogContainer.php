<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/12/4
 * Time: 18:58
 */

namespace Framework\Support\Containers;


use Phalcon\Di;

class LogContainer implements FacadeInterface
{
    use Container;

    /**
     * @return string|object
     */
    public static function getFacadesAccessor()
    {
        return Di::getDefault()->getShared('logger');
    }
}