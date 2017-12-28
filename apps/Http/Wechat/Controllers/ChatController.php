<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/12/26
 * Time: 14:27
 */

namespace Apps\Http\Wechat\Controllers;


use Apps\Http\Common\Controllers\Controller;
use Apps\Http\Wechat\Models\AutoModel;
use GatewayClient\Gateway;

class ChatController extends Controller
{
    public function send()
    {
        $auto = new AutoModel();
        $loginUid = $auto->getUid();
        $mine = $this->request->get('mine');
        $to   = $this->request->get('to');
        $type = $to['type'];

        Gateway::sendToUid($to['id'], json_encode([
            'message_type' => 'chatMessage',
            'data'         => [
                'username'  => $mine['username'],
                'avatar'    => $mine['avatar'],
                'id'        => $type === 'friend' ? $loginUid : $to['id'],
                'type'      => $type,
                'content'   => htmlspecialchars($mine['content']),
                'mine'      => false,
                'timestamp' => time() * 1000,
            ],
        ], JSON_UNESCAPED_UNICODE));
    }
}