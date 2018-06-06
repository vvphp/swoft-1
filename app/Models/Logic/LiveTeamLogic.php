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

use App\Models\Entity\LiveTeamTable;

use Swoft\Bean\Annotation\Bean;
use Swoft\Rpc\Client\Bean\Annotation\Reference;
use Swoft\Bean\Annotation\Inject;
use App\Models\Dao\LiveTeamDao;

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

    /**
     *
     * @Inject()
     * @var LiveTeamDao
     */
    private  $liveTeamDao;

    /**
     * 根据 team_name查询是否存在，如果不存在则插入，如果存在则直接返回true
     * @param $data
     * @return bool|mixed
     */
    public function saveLiveTeam($data)
    {
        if(empty($data['team_name'])){
             return 0;
        }
        return $this->liveTeamDao->saveLiveTeam($data);
    }

    /**
     * 根据 team_name 查询表中是否已经存在数据
     * @param string $team_name
     * @param  string $symbol 符号，如果传like表示模糊查询，否则就是全等查询
     * @return mixed
     */
    public function getTeamIdByName($team_name='',$symbol='')
    {
        if(empty($team_name)){
             return [];
        }
        return   $this->liveTeamDao->getTeamIdByName($team_name,$symbol);
    }

    /**
     * 根据ID 数组查询
     * @param array $team_id_list
     * @return array
     */
    public function getTeamDataByIdList(array $team_id_list)
    {
        $teamList = [];
        if(empty($team_id_list)){
             return $teamList;
        }
       $teamData = $this->liveTeamDao->getTeamDataByIdList($team_id_list);
       foreach($teamData as $key => $value){
            $teamId = $value['id'];
            $teamList[$teamId] = $value;
        }
        return $teamList;
    }

    /**
     * 插入数据
     * @param $data
     * @return mixed
     */
    public  function saveTeamByData($data)
    {
        if(empty($data)){
              return false;
        }
        return $this->liveTeamDao->saveTeamByData($data);
    }

}
