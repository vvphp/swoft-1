<?php
/**
 * 短信验证码
 * Date: 2018/5/2
 * Time: 19:30
 */
namespace App\Common\Verifcode;

use Swoft\Cache\Cache;
use Swoft\Bean\Annotation\Inject;

class  Code{

    protected  static $prefix='sms_';

    protected  static $outTime = 300;

    /**
     * @Inject()
     * @var \Swoft\Redis\Redis
     */
    private $redis;

    /**
     * @param int $len
     */
    public static  function  generatingVerificationCode($len=4)
    {
        $arr = range('a','z');
        shuffle($arr);
        $intArr = range(1,99);
        shuffle($intArr);
        $code = $intArr[0].$arr[1].$intArr[1].$arr[0];
        $code =  substr($len,0,$len);
        if(strlen($code) < $len){
            $code = str_pad($code,$len,mt_rand(0,9));
        }
        return $code;
    }

    /**
     * 发短信之前的验证
     *
     * @param $phone
     */
    public  function  sendBeforeCheck($phone)
    {
        $incrKey = self::memberSmsCountKey($phone);
        $count =  $this->redis->get($incrKey);
        if(!empty($count) && $count > 5){
            return false;
        }
        return true;
    }

    /**
     * 将验证码保存到redis中
     * @param $phone
     * @param $code
     */
    public  function saveRedisCode($phone,$code)
    {
        $key = self::memberCodeKey($phone);
        $this->redis->set($key,$code,self::$outTime);
        $incrKey = self::memberSmsCountKey($phone);
        $has =  $this->redis->has($incrKey);
        $end = mktime(23,59,59,date("m"),date("d"),date("Y"));
        if(empty($has)){
           $this->redis->set($incrKey,1,$end-time());
        }else{
            $this->redis->incr($incrKey);
       }
     return true;
    }

    /**
     * 获取在redis中的验证码
     * @param $phone
     * @return bool|string
     */
    public  function getMemberCode($phone)
    {
        $key = self::memberCodeKey($phone);
        return  $this->redis->get($key);
    }

    /**
     * 短信验证码键值
     * @param $phone
     * @return string
     */
    public static function memberCodeKey($phone)
    {
        return self::$prefix.$phone;
    }

    /**
     * 短信发送计数器key
     * @param $phone
     * @return string
     */
    public static function memberSmsCountKey($phone)
    {
       return 'incr_'.$phone;
    }

}


