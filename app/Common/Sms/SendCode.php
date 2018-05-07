<?php
/**
 * 发送短信验证码
 * Date: 2018/5/2
 * Time: 19:30
 */
namespace App\Common\Sms;

use Swoft\Cache\Cache;
use Swoft\Bean\Annotation\Inject;
use App\Common\Tool\Valitron;
use App\Common\Tool\Util;
use App\Common\Tool\VerifCode;
use Swoft\Task\Task;

/**
 * @\Swoft\Bean\Annotation\Bean("SendCode")
 */
class  SendCode{

    /**
     * 短信验证码前缀
     * @var string
     */
    protected  static $prefix = 'sms_';

    /**
     * 验证码保存时间
     * @var int
     */
    protected  static $outTime = 300;

    /**
     * 当天同一手机最多可发送的次数
     * @var int
     */
    protected  static $maxCount = 5;

    /**
     * @Inject()
     * @var \Swoft\Redis\Redis
     */
    private $redis;

    /**
     * @\Swoft\Bean\Annotation\Inject("Valitron")
     * @var \App\Common\Tool\Valitron
     */
    private $valitron;


    /**
     * 发短信之前的验证 ,同一手机号一天不能超过5次
     *
     * @param $phone
     * @return  bool
     */
    public  function  sendBeforeCheck($phone)
    {
        $incrKey = self::memberSmsCountKey($phone);
        $count =  $this->redis->get($incrKey);
        if(!empty($count) && $count > self::$maxCount){
            return false;
        }
        return true;
    }

    /**
     * 发短信之前 检查数据，手机号，token
     * @param array $data
     * @param array $field
     * @return bool
     * @throws \Exception
     */
    public function checkData($data=[],$field=[])
    {
        if(empty($data) || empty($field)){
             return true;
        }
       $result = $this->valitron->valitronSendSms($data,$field);
       if(is_array($result)){
            $msgArr = array_pop($result);
            throw new \Exception($msgArr[0] ?? '' );
       }
        $token = isset($data['token']) ?? '';
        $getToken =  $this->redis->get($token);
        $check = $this->valitron->valitronEquals($getToken,$token);
        if($check == false){
            throw new \Exception( Util::getMsg('Infoexpired'));
        }
       return true;
    }

    /**
     * 发送短信
     * @param $phone
     * @param string $token
     * @return \App\Common\Sms\SimpleXMLElement|mixed
     * @throws \Exception
     */
    public  function sendSms($phone,$token='')
    {
        $countCheck = $this->sendBeforeCheck($phone);
        if($countCheck == false){
            throw new \Exception( Util::getMsg('smsSendLimit'));
        }
        try{
            $data = ['phone' => $phone,'token'=>$token];
            $field = ['phone'];
            if(!empty($token)){
                array_push($field,'token');
            }
            $this->checkData($data,$field);
            $code = $this->getCode($phone);
            //发短信放到task进程里去处理
            $res  = Task::deliver('send', 'sendSms', [$phone, $code], Task::TYPE_CO);
            if($res){
                  $this->saveRedisCode($phone,$code);
            }else{
                throw new \Exception( Util::getMsg('smsCodeError'));
            }
        }catch(\Exception $e){
             throw new \Exception( $e->getMessage());
        }
        return true;
    }

    /**
     * 获取生成的验证码
     * @param $phone
     * @return bool|string
     */
    public function getCode($phone)
    {
        //看上一次发送短信的时间是否已经大于5分钟,不大于5分钟、还是用之前的验证码
        $code = $this->getMemberCode($phone);
        if(empty($code)){
            $code = VerifCode::generatingVerificationCode();
        }
        return $code;
    }

    /**
     * [comparisonCode 比较验证码]
     * @param  [type] $phone [description]
     * @param  [type] $code  [description]
     * @return [type]        [description]
     */
    public function comparisonCode($phone,$code)
    {
         $getCode = $this->getCode($phone);
         if(empty($getCode) || $getCode != $code ){
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
    * [delRedisCode 删除保存在redis中的key]
    * @param  [type] $phone [description]
    * @return [type]        [description]
    */
   public function delRedisCode($phone)
   {
      $key = self::memberCodeKey($phone);
      return  $this->redis->delete($key);
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


