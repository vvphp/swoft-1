<?php
/**
 * 用户 逻辑层
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Models\Logic;

use Swoft\Bean\Annotation\Bean;
use Swoft\Rpc\Client\Bean\Annotation\Reference;
use Swoft\Bean\Annotation\Inject;
use App\Models\Dao\LiveUserDao;
use App\Common\Tool\Util;
use App\Common\Helper\Login;
use App\Common\McrYpt\DES1;

/**
 * 用户逻辑层
 * 同时可以被controller server task使用
 *
 * @Bean()
 * @uses      LiveUserLogic
 * @version   2017年10月15日
 * @author    stelin <phpcrazy@126.com>
 * @copyright Copyright 2010-2016 swoft software
 * @license   PHP Version 7.x {@link http://www.php.net/license/3_0.txt}
 */
class LiveUserLogic
{

    /**
     *
     * @Inject()
     * @var LiveUserDao
     */
    private  $LiveUserDao;

    /**
     * @\Swoft\Bean\Annotation\Inject("Valitron")
     * @var \App\Common\Tool\Valitron
     */
    private $valitron;

    /**
     * @\Swoft\Bean\Annotation\Inject("SendCode")
     * @var \App\Common\Sms\SendCode
     */
    private $sendCode;



    /**
     * 根据 title 查询是否存在，如果不存在则插入，如果存在则直接返回true
     * @param $data
     * @return bool|mixed
     */
    public function saveUser($data)
    {
        if(empty($data['phone']) || empty($data['password']) || empty($data['nike_name'])){
              return 0;
        }
        return $this->LiveUserDao->saveUser($data);
   }

    /**
     * 根据手机号和密码查询用户信息
     * @param string $phone
     * @param string $password
     * @return array
     */
    public function getUserInfoByPhonePassword($phone,$password)
    {
       return   $this->LiveUserDao->getUserInfoByPhonePassword($phone,$password);
    }

    /**
     * 根据手机号查询用户
     * @param $phone
     * @return array
     */
    public function getUserListByPhone($phone)
    {
        if(empty($phone)){
            return [];
        }
        return   $this->LiveUserDao->getUserListByPhone($phone);
    }


    /**
     * 根据用户ID查询用户信息
     * @param int $userId
     * @return array
     */
    public function getUserInfoById($userId)
    {
        return  $this->LiveUserDao->getUserInfoById($userId);
    }

    /**
     * 更新最后登录的时间
     * @param $userId
     * @param $date
     * @return mixed
     */
    public function updateLastLoginTime($userId,$date)
    {
        return  $this->LiveUserDao->updateLastLoginTime($userId,$date);
    }

    /**
     * 生成加密密码
     * @param $password
     * @return string
     */
    public function generatePassword($password)
    {
         return  md5($password.'zxr');
    }


    /**
     * 注册逻辑
     * @param array $post
     * @return array
     */
    public function register($post = [])
    {
        $ret = ['check' => false,'msg' => null,'data' => [] ];
        $check = $this->valitron->verificationRegister($post);
        if(is_array($check)){
            $msgArr = array_pop($check);
            $ret['msg'] = $msgArr[0];
            return $ret;
        }
        //判断验证码
        $checkCode = $this->sendCode->comparisonCode($post['phone'],$post['verCode']);
        if(!$checkCode){
            $ret['msg'] = 'login_verify_error';
            return $ret;
        }
        $post['password'] = $this->generatePassword($post['password']);
        $userList =  $this->getUserListByPhone($post['phone']);
        if(!empty($userList)){
            $ret['msg'] = 'register_phone_exists';
            return $ret;
        }
        $userId = $this->saveUser($post);
        if($userId){
            $userInfo = $this->getUserInfoById($userId);
            //update last login date
            $this->updateLastLoginTime($userId,time());
            $ret = ['check' => true,'msg' => '','data'=> $userInfo ];
            return $ret;
        }else{
            $ret['msg'] = 'register_fail';
            return $ret;
        }
    }

    /**
     * 获取当前登录的用户信息
     * @param $request
     * @return array|bool|string
     */
    public function getLoginUserInfo($request)
    {
        $userInfo = [];
        $userCookieData = $request->cookie(Login::getFrontCookieName());
        if($userCookieData){
            $userInfo =  DES1::decrypt($userCookieData);
        }
        return $userInfo;
    }

}
