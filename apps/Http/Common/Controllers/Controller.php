<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2017/11/21
 * Time: 14:24
 */

namespace Apps\Http\Common\Controllers;


use GatewayClient\Gateway;

class Controller extends \Phalcon\Mvc\Controller
{
    public function initialize()
    {
        $this->cookies->useEncryption(false);
        $this->view->webTitle = '站点标题';
        Gateway::$registerAddress = '127.0.0.1:1238';
    }

    public function response($data)
    {
        if( is_string($data) ){
            $this->response->setContentType('text/html; charset=utf-8');
            $this->response->setContent($data);
        }else{
            $this->response->setContentType('application/json');
            $this->response->setContent(json_encode($data,JSON_UNESCAPED_UNICODE));
        }
        return $this->response;
    }

    public function afterExecuteRoute()
    {
        $return = $this->dispatcher->getReturnedValue();
        if (!$return instanceof $this->response && is_array($return)) {
            // 使用 dispatcher::setReturnedValue 设置一下返回值，否则外部 response::getContent 获取不到内容
            $this->dispatcher->setReturnedValue($this->response($return)->getContent());
        }
    }
}