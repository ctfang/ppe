<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/11/24
 * Time: 17:42
 */

namespace Apps\Modules\Index\Controllers;

use Phalcon\Mvc\Controller;

class ErrorController extends Controller
{
    /**
     * 404
     */
    public function notFound()
    {
        $this->view->pick('Base/notFound');
    }
}