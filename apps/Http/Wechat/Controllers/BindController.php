<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/12/26
 * Time: 13:56
 */

namespace Apps\Http\Wechat\Controllers;


use Apps\Http\Common\Controllers\Controller;
use Apps\Http\Wechat\Models\AutoModel;
use GatewayClient\Gateway;

class BindController extends Controller
{
    public function index()
    {
        $auto      = new AutoModel();
        $client_id = $this->request->get('client_id');
        Gateway::bindUid($client_id, $auto->getUid());
    }
}