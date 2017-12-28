<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/12/25
 * Time: 16:53
 */

namespace Apps\Facades\Containers;


use Framework\Support\Containers\Container;
use Framework\Support\Containers\FacadeInterface;
use Phalcon\Di;

class SessionContainer implements FacadeInterface
{
    use Container;

    /**
     * 映射实体类
     *
     * @return string|object
     */
    public static function getFacadesAccessor()
    {
        return Di::getDefault()->getShared('session');
    }
}