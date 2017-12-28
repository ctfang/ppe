<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/12/25
 * Time: 15:01
 */

namespace Apps\Http\Wechat\Controllers;


use Apps\Http\Common\Controllers\Controller;
use Apps\Http\Wechat\Models\AutoModel;

class IndexController extends Controller
{
    /**
     * 首页
     */
    public function index()
    {
        $auto = new AutoModel();
        if ($auto->isLogin()) {
            $loginUser             = $auto->getLoginUser();
            $this->view->uid       = $loginUser['id'];
            $this->view->loginUser = json_encode([
                "type"     => "init",
                "username" => $loginUser['username'],
                "avatar"   => 'http://'.$_SERVER['HTTP_HOST'].'/UserInfo/getAvatar?name='.$loginUser['username'],
                "sign"     => $loginUser['sign'],
                "id"       => $loginUser['id'],
            ],JSON_UNESCAPED_UNICODE);
            $this->view->pick('home');
        } else {
            $username             = $this->cookies->get('username');
            $this->view->username = $username;
            $this->view->pick('Public/login');
        }
    }

    /**
     * 登录
     */
    public function doLogin()
    {
        $username = $this->request->get('username', 'string');
        $password = $this->request->get('pwd','string');
        $this->cookies->set('username', $username);
        (new AutoModel())->saveLogin($username,$password);
        return $this->response->redirect('/');
    }

    /**
     * 登录
     */
    public function loginOut()
    {
        (new AutoModel())->loginOut();
        return $this->response->redirect('/');
    }
}