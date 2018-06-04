<?php
/**
 * 公共方法类
 * Date: 2018/5/2
 * Time: 15:47
 */
namespace App\Common\Tool;

use Swoft\Http\Message\Server\Request;
use Swoft\Helper\ResponseHelper;
use Swoft\App;

class Base{

    public static function getConfig($sysName)
    {
        $config = App::$properties[$sysName];
        return $config;
    }

    /**
     * 获取指定的key
     * @param $sysName
     * @param $key
     * @return string
     */
    public static function getKey($sysName,$key='')
    {
        $config = self::getConfig($sysName);
        if(empty($key)){
            return  $config;
        }
        return $config[$key] ? $config[$key] : '';
    }

    /**
     * 获取redis KEY 配置
     * @param $key
     * @return string
     */
    public static function getRedisKey($key='')
    {
        return Base::getKey('redisKey',$key);
    }

    /**
     * 获取自定义的key
     * @param string $key
     * @return string
     */
    public static function getParameter($key='')
    {
        return Base::getKey('systemParameter',$key);
    }


}


