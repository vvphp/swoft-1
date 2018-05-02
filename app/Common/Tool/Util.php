<?php
/**
 * 工具类
 * Date: 2018/5/2
 * Time: 15:47
 */
namespace App\Common\Tool;

use Swoft\Http\Message\Server\Request;

class Util{

    /**
     * 登录页面 生成token
     * @param Request $request
     * @return string
     */
    public static function generatingLoginToken(Request $request)
    {
        $server = $request->getSwooleRequest()->server;
        $token = md5( $server['remote_addr']. uniqid());
        return $token;
    }

}


