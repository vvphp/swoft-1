<?php
/**
 * 管理员表 逻辑层
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Models\Logic;

use App\Models\Entity\LiveAdminUser;

use Swoft\Bean\Annotation\Bean;
use Swoft\Rpc\Client\Bean\Annotation\Reference;
use App\Models\Dao\LiveAdminUserDao;
use Swoft\Bean\Annotation\Inject;

/**
 *
 * @Bean()
 * @uses      LivAdminUserLogic
 * @version   2018年05月22日
 * @author    zxr <strive965432@gmail.com>
 * @copyright Copyright 2010-2016 swoft software
 * @license   PHP Version 7.x {@link http://www.php.net/license/3_0.txt}
 */
class LiveAdminUserLogic
{
    /**
     *
     * @Inject()
     * @var LiveAdminUserDao
     */
     private  $adminUserDao;


    /**
     * 根据 user_id 查询表中用户信息
     * @param int $user_id
     * @return mixed
     */
    public function getUserDataById(int $user_id)
    {
         return $this->adminUserDao->getUserDataById($user_id);
    }

    /**
     * 检查用户名和密码是否正确
     * @param $userName
     * @param $passWord
     * @return array
     */
    public function checkUserByPass($userName,$passWord)
    {
         return $this->adminUserDao->checkUserByPass($userName,$passWord);
    }

    /**
     * 修改数据
     * @param $id
     * @param $data
     * @return mixed
     */
    public function updateUserDataById($id,$data)
    {
         return $this->adminUserDao->updateUserDataById($id,$data);
    }

}