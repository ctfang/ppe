<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/12/15
 * Time: 17:26
 */

namespace Apps\Http\Index\Controllers;


use Apps\Http\Common\Controllers\Controller;
use Phalcon\Di;

class DbController extends Controller
{
    public function index()
    {
        dump($this->db->listTables());
        dump($this->di);
    }
}