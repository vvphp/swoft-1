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


}
