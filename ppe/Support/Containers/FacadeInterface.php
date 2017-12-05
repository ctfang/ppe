<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/12/4
 * Time: 19:52
 */

namespace Framework\Support\Containers;


interface FacadeInterface
{
    /**
     * 映射实体类
     *
     * @return string|object
     */
    public static  function getFacadesAccessor();
}