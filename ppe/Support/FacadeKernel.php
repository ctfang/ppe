<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/12/4
 * Time: 18:09
 */

namespace Framework\Support;


abstract class FacadeKernel
{
    protected $facadeList;

    public function __construct()
    {
        $this->facadeList = $this->register();
    }

    /**
     * @return array
     */
    abstract protected function register();

    /**
     * 是否启用
     *
     * @param $class
     * @return bool
     */
    public function hasClass($class)
    {
        return isset($this->facadeList[$class])?true:false;
    }

    public function getFacade($class)
    {
        return $this->facadeList[$class];
    }

}