<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/12/15
 * Time: 17:02
 */

namespace Apps\Facades\Containers;


use Framework\Support\Containers\Container;
use Framework\Support\Containers\FacadeInterface;
use Phalcon\Di;

class ConfigContainer implements FacadeInterface
{
    use Container;

    /**
     * 映射实体类
     *
     * @return string|object
     */
    public static function getFacadesAccessor()
    {
        return Di::getDefault()->setShared('config');
    }
}