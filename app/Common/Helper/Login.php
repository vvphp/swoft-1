<?php
/**
 * 登录助手类
 * Date: 2018/5/2
 * Time: 19:30
 */
namespace App\Common\Helper;
use Swoft\App;
use Psr\Http\Message\ServerRequestInterface;
use App\Common\McrYpt\DES1;

class  Login{

    public static function getConfig()
    {
        $config = App::$properties['systemParameter'];
        return $config;
    }

    /**
     * 后台登录的cookie 名
     * @return string
     */
    public static function getAdminCookieName()
    {
        $config = self::getConfig();
         return isset($config['adminCookie']) ? $config['adminCookie']:'adminLogin';
    }

    /**
     * 获取当前登录用户信息
     * @param ServerRequestInterface $request
     * @return array|bool|string
     */
    public static function getAdminUserInfo(ServerRequestInterface $request)
    {
        $cookieName = self::getAdminCookieName();
        $cookie = $request->getCookieParams();
        $cookData = isset($cookie[$cookieName]) ? trim($cookie[$cookieName]) : '';
        if(empty($cookData)){
            return [];
        }
        $userInfo = DES1::decrypt($cookData);
        return $userInfo;
    }

    /**
     * 是否登录
     * @param ServerRequestInterface $request
     * @return bool
     */
    public function isAuth(ServerRequestInterface $request)
    {
        $userInfo = self::getAdminUserInfo($request);
        if(empty($userInfo) || !isset($userInfo['id']) ){
             return false;
        }
         return true;
    }

 }


