<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/12/25
 * Time: 20:05
 */

namespace Apps\Http\Wechat\Controllers;


use Apps\Http\Common\Controllers\Controller;
use Apps\Http\Wechat\Models\AutoModel;
use Apps\Http\Wechat\Models\GroupModel;
use Apps\Http\Wechat\Models\UserGroupModel;
use Apps\Http\Wechat\Models\UserModel;
use Identicon\Identicon;

class UserInfoController extends Controller
{
    public function init()
    {
        $auto     = new AutoModel();
        $groupArr = GroupModel::find()->toArray();
        $group[]  = [
            'id'        => 1,
            'avatar'    => '',
            'groupname' => '默认分组',
            'list'      => UserModel::find()
        ];
        return $this->response([
            'code' => 0,
            'msg'  => '',
            'data' => [
                'mine'   => $auto->getLoginUser(),
                'friend' => $group,
                'group'  => $groupArr
            ],
        ]);
    }

    public function getAvatar()
    {
        $name = $this->request->get('name', 'string', 0);
        (new Identicon())->displayImage($name);
    }

    public function getMembers()
    {

    }
}