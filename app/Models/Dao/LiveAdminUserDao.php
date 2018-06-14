<?php
/**
 * 管理员表 Models层
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Models\Dao;

use App\Models\Entity\LiveAdminUser;

use Swoft\Bean\Annotation\Bean;
use Swoft\Rpc\Client\Bean\Annotation\Reference;

/**
 *
 * @Bean()
 * @uses      LiveAdminUserDao
 * @version   2018年05月22日
 * @author    zxr <strive965432@gmail.com>
 * @copyright Copyright 2010-2016 swoft software
 * @license   PHP Version 7.x {@link http://www.php.net/license/3_0.txt}
 */
class LiveAdminUserDao
{

    /**
     * 根据 user_id 查询表中用户信息
     * @param int $user_id
     * @return mixed
     */
    public function getUserDataById($user_id)
    {
        $where = ['id' => $user_id ];
        $fields = ['id','name','nikename'];
        if(is_array($user_id)){
              $result =  LiveAdminUser::findAll($where, ['fields' => $fields])->getResult();
        }else{
              $result =  LiveAdminUser::findOne($where, ['fields' => $fields])->getResult();
        }
        return empty($result) ? [] : $result->toArray();
    }


    /**
     * 检查用户名和密码是否正确
     * @param $userName
     * @param $passWord
     * @return array
     */
    public function checkUserByPass($userName,$passWord)
    {
        $where = [
            'user_name' => $userName,
            'password'  => $passWord
        ];
        $fields = ['id','is_live','status','add_date','name','nikename','last_login_date'];
        $result =  LiveAdminUser::findOne($where, ['fields' => $fields])->getResult();
        return empty($result) ? [] : $result->toArray();
    }


    /**
     * 修改数据
     * @param $id
     * @param $data
     * @return mixed
     */
    public function updateUserDataById($id,$data)
    {
        return  LiveAdminUser::updateOne($data,['id' => $id])->getResult();
    }



}