<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/12/25
 * Time: 20:32
 */

namespace Apps\Http\Wechat\Models;


use Phalcon\Mvc\Model;

class UserGroupModel extends Model
{
    public function initialize()
    {
        $this->setSource("user_group");
        $this->belongsTo("group_id", GroupModel::class, "id",['alias'=>'GroupModel']);
        $this->belongsTo("user_id", UserModel::class, "id",['alias'=>'UserModel']);
    }
}