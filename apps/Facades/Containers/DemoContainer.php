<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/12/5
 * Time: 18:46
 */

namespace Apps\Facades\Containers;


use Framework\Support\Containers\Container;
use Framework\Support\Containers\FacadeInterface;

class DemoContainer implements FacadeInterface
{
    use Container;

    /**
     * 映射实体类
     *
     * @return string|object
     */
    public static function getFacadesAccessor()
    {
        return test::class;
        // or
        //return new test();
        // return $di->getShared('test');
    }
}

/**
 * 测试
 * @package Apps\Facades\Containers
 */
class test
{
    public function test()
    {
        echo 'OK';
    }
}