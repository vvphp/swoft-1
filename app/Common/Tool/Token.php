<?php
/**
 * 加密类
 * Date: 2018/5/2
 * Time: 15:47
 */
namespace App\Common\Tool;

use phpDocumentor\Reflection\Types\Boolean;
use Swoft\Http\Message\Server\Request;
use Swoft\Http\Message\Cookie\Cookie;
use Swoft\Cache\Cache;
use Swoft\Bean\Annotation\Inject;

/**
 * @\Swoft\Bean\Annotation\Bean("Token")
 */
class Token{

    /**
     * @Inject()
     * @var \Swoft\Redis\Redis
     */
    private $redis;

    /**
     * 登录时存放在COOKIE中的的Token名
     * @var string
     */
    private $cookie = 'liveLoginToken';


    /**
     * Token存放的时间
     * @var int
     */
    private $tokenSaveTime = 300;

    /**
     * 登录页面 生成token
     * @param Request $request
     * @return string
     */
    public  function generatingLoginToken(Request $request)
    {
        $server = $request->getSwooleRequest()->server;
        $token = md5( $server['remote_addr']. uniqid());
        return $token;
    }

    /**
     * 保存token到redis和cookie中
     * @param $token
     * @param $request
     * @param $type
     * @return  Boolean
     */
    public  function saveToken($token,$request,$type='login')
    {
        $cookie = $this->saveCookieToken($token,$request);
        $this->saveRedisToken($token);
        return $cookie;
    }

    /**
     * 将token保存到Cookie中
     * @param $token
     * @param $request
     * @return Cookie
     */
    public function saveCookieToken($token,$request)
    {
        $cookie = new Cookie($this->cookie,$token,time()+$this->tokenSaveTime,'/',$request->getUri()->getHost());
        return $cookie;
    }

    /**
     * 删除cookie中的token
     * @param $token
     * @param $request
     * @return Cookie
     */
    public function delCookieToken($token,$request)
    {
        $cookie = new Cookie($this->cookie,$token,time()-$this->tokenSaveTime,'/',$request->getUri()->getHost());
        return $cookie;
    }


    /**
     * 将token保存到redis中
     * @param $token
     * @return bool
     */
    public function saveRedisToken($token)
    {
       return  $this->redis->set($token, $token,$this->tokenSaveTime);
    }
   
    /**
     * [delToken 删除redis token]
     * @param  [type] $token [description]
     * @return [type]        [description]
     */
    public function delToken($token)
    {
        return $this->redis->delete($token);
    }


    /**
     * 获取当前token
     * @param Request $request
     * @return string $token
     */
    public function getCookie(Request $request)
    {
        $token = $request->cookie($this->cookie);
        return $token;
    }

    /**
     * 验证token
     * @param $token
     * @return  bool
     */
    public function verifyToken($token)
    {
        $ret =  $this->redis->get($token);
        return !empty($ret);
    }

    /**
     * 设置cookie 名字
     * @param $name
     */
    public function setCookieName( $name )
    {
        $this->cookie = $name;
    }


}


