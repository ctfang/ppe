<?php
/**
 * Created by PhpStorm.
 * User: baichou
 * Date: 2017/12/20
 * Time: 18:18
 */

namespace Apps\Facades\Containers;


use Framework\Support\Containers\Container;
use Framework\Support\Containers\FacadeInterface;
use Phalcon\Di;

class QueueContainer implements FacadeInterface
{
    use Container;

    /**
     * 映射实体类
     *
     * @return string|object
     */
    public static function getFacadesAccessor()
    {
        return Di::getDefault()->getShared('queue');
    }
}