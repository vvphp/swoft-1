<?php
/**
 * 球队表 逻辑层
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Models\Logic;

use App\Models\Entity\LiveTeam;

use Swoft\Bean\Annotation\Bean;
use Swoft\Rpc\Client\Bean\Annotation\Reference;

/**
 * 用户逻辑层
 * 同时可以被controller server task使用
 *
 * @Bean()
 * @uses      LiveTeamLogic
 * @version   2017年10月15日
 * @author    stelin <phpcrazy@126.com>
 * @copyright Copyright 2010-2016 swoft software
 * @license   PHP Version 7.x {@link http://www.php.net/license/3_0.txt}
 */
class LiveTeamLogic
{
     
    public function saveLiveTeam($data)
    {
        if(!empty($data['home_team'])){
            //先查一下球队是否已经在表里存在
            $where = [
                'team_name' => $value['home_team']
            ];

           $result =  LiveTeam::findOne($where, ['fields' => ['id']])->getResult();
        
           var_dump($result);
        }

    }



    public function getUserInfo(array $uids)
    {
        $user = new User();
        $user = [
            'name' => 'boby',
            'desc' => 'this is boby'
        ];

        $data = [];
        foreach ($uids as $uid) {
            $user['uid'] = $uid;
            $data[] = $user;
        }

        return $data;
    }
}