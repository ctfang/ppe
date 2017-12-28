<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/12/25
 * Time: 20:40
 */

namespace Apps\Http\Wechat\Models;


use Phalcon\Mvc\Model;

class UserModel extends Model
{
    public $username;
    public $password;
    public $sign;
    public $status;
    public $avatar;

    public function getSource()
    {
        return "user";
    }
}