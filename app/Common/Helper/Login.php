<?php
/**
 * 登录助手类
 * Date: 2018/5/2
 * Time: 19:30
 */
namespace App\Common\Helper;
use Swoft\App;

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
         return isset($config['adminCookie']) ? $config['adminCookie']:'aaa';
    }




 }


