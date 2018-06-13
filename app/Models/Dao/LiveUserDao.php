<?php
/**
 * 用户表 MODEL层 具体的数据库操作
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Models\Dao;

use Swoft\App;
use Swoft\Bean\Annotation\Bean;
use Swoft\Rpc\Client\Bean\Annotation\Reference;
use App\Models\Entity\LiveUserInfo;

/**
 * @Bean()
 * @uses      LiveUserDao
 * @version   2017年10月15日
 * @author    stelin <phpcrazy@126.com>
 * @copyright Copyright 2010-2016 swoft software
 * @license   PHP Version 7.x {@link http://www.php.net/license/3_0.txt}
 */
class LiveUserDao
{
    private $fields = ['id','phone','password','nike_name','status','last_login_time','add_date'];


    /**
     * 根据手机号和密码查询用户信息
     * @param $phone
     * @param $password
     * @return array
     */
    public function getUserInfoByPhonePassword($phone,$password)
    {
        $where = ['phone' => $phone,'password' => $password ];
        $result = LiveUserInfo::findOne($where, ['fields' => $this->fields])->getResult();
        return empty($result) ? [] : $result->toArray();
    }

    /**
     * 根据用户ID查询用户信息
     * @param int $userId
     * @return array
     */
    public function getUserInfoById($userId)
    {
        $where = ['id' => $userId];
        $result = LiveUserInfo::findOne($where, ['fields' => $this->fields])->getResult();
        return empty($result) ? [] : $result->toArray();
    }

    /**
     * 根据用户ID批量查询
     * @param array $userIdList
     * @return array
     */
    public function getUserListByIdList(array $userIdList)
    {
        $where = ['id' => $userIdList];
        $result = LiveUserInfo::findAll($where, ['fields' => ['id','nike_name']])->getResult();
        return empty($result) ? [] : $result->toArray();
    }


    /**
     * 根据手机号查询用户
     * @param $phone
     * @return array
     */
    public function getUserListByPhone($phone)
    {
        $where = ['phone' => $phone];
        $result = LiveUserInfo::findAll($where, ['fields' => $this->fields])->getResult();
        return empty($result) ? [] : $result->toArray();
    }

    /**
     * 更新最后登录的时间
     * @param $userId
     * @param $date
     * @return mixed
     */
    public function updateLastLoginTime($userId,$date)
    {
        $data = ['last_login_time' => $date];
        $where  = ['id' => $userId ];
        return  LiveUserInfo::updateOne($data, $where)->getResult();
    }

    /**
     * 保存用户
     * @param $data
     * @return mixed
     */
    public function saveUser($data)
    {
        $values = [
            [
            'phone'     =>  isset($data['phone']) ? $data['phone'] : '',
            'password'  =>  isset($data['password']) ? $data['password'] : '',
            'nike_name' =>  isset($data['nike_name']) ? $data['nike_name'] : '',
            'add_date'  =>  time()
            ]
        ];
        return  LiveUserInfo::batchInsert($values)->getResult();
    }

}