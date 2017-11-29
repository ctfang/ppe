<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/11/29
 * Time: 14:30
 */

namespace Framework\Support;

use Whoops\Run;

interface ExceptionKernel
{
    public function register(Run &$run);
}