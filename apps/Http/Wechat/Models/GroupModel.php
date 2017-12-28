<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/12/25
 * Time: 20:29
 */

namespace Apps\Http\Wechat\Models;


use Phalcon\Mvc\Model;

class GroupModel extends Model
{
    public function initialize()
    {
        $this->setSource("group");
        $this->hasMany("id", UserGroupModel::class, "group_id");
    }
}