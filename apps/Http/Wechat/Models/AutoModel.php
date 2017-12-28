<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/12/25
 * Time: 16:47
 */

namespace Apps\Http\Wechat\Models;


use Phalcon\Di;

class AutoModel
{
    public static $isLogin  = 'isLogin';
    public static $uid      = 'uid';
    public static $username = 'username';


    public function isLogin()
    {
        if (\Session::get(self::$isLogin)) {
            return true;
        }
        return false;
    }

    public function getLoginUser()
    {
        $user = UserModel::findFirst(\Session::get(self::$uid));
        return $user->toArray();
    }

    public function getUid()
    {
        return \Session::get(self::$uid);
    }

    public function saveLogin($username, $password)
    {
        $user = UserModel::findFirst(["username='{$username}'"]);
        if ($user) {
            if ( !Di::getDefault()->get('security')->checkHash($password,$user->password)) {
                return false;
            }
            \Session::set(AutoModel::$isLogin, true);
            \Session::set(AutoModel::$uid, $user->id);
            \Session::set(AutoModel::$username, $username);
            return true;
        } else {
            $UserModel           = new UserModel();
            $UserModel->username = $username;
            $UserModel->password = Di::getDefault()->getShared('security')->hash($password);;
            $UserModel->sign     = '';
            $UserModel->status   = 'offline';
            $UserModel->avatar   = '/UserInfo/getAvatar?name='.$username;
            $isOk = $UserModel->create();
            if ($isOk) {
                return $this->saveLogin($username, $password);
            }
        }
        return false;
    }

    public function loginOut()
    {
        \Session::set(AutoModel::$isLogin, false);
    }
}