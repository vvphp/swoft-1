<?php
/**
 * 赛程表 逻辑层
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Models\Logic;

use App\Models\Entity\LiveGameSchedule;
use Swoft\Bean\Annotation\Bean;
use Swoft\Rpc\Client\Bean\Annotation\Reference;

/**
 * @Bean()
 * @uses      LiveGameLogic
 * @version   2017年10月15日
 * @author    stelin <phpcrazy@126.com>
 * @copyright Copyright 2010-2016 swoft software
 * @license   PHP Version 7.x {@link http://www.php.net/license/3_0.txt}
 */
class LiveGameLogic
{
    /**
     * 先判断是否存在，如果不存在则插入，如果存在则直接返回true
     * @param $data
     * @return bool|mixed
     */
    public function saveLiveGame($data)
    {
      if(empty($data) || empty($data['game_date']) || empty($data['data_time']) || empty($data['match_id'])){
            return 0 ;
        }
       $result = $this->getGameIdByWhere($data);
       if(!empty($result)){
            return $result['id'];
       }
      $ret = $this->saveGameByData($data);
      return $ret;
    }



    /**
     * 根据 $where 条件 查询
     * @param array $where
     * @return mixed
     */
    public function getGameIdByWhere($where)
    {
        $filter = [];
        if(isset($where['match_id'])){
            $filter[ 'match_id'] = $where['match_id'];
        }
        if(isset($where['game_date'])){
            $filter[ 'game_date'] = $where['game_date'];
        }
        if(isset($where['data_time'])){
            $filter[ 'data_time'] = $where['data_time'];
        }
        if(isset($where['home_team_id'])){
            $filter[ 'home_team_id'] = $where['home_team_id'];
        }
        if(isset($where['visiting_team_id'])){
            $filter[ 'visiting_team_id'] = $where['visiting_team_id'];
        }
        $result =  LiveGameSchedule::findOne($filter, ['fields' => ['id']])->getResult();
        if(!empty($result)){
            $result = $result->toArray();
        }
        return $result;
    }

    /**
     * 插入数据
     * @param $data
     * @return mixed
     */
    public  function saveGameByData($data)
    {
        $values = [
            [
              'match_id' => $data['match_id'],
              'live_member_id' => $data['live_member_id'],
              'game_date' => $data['game_date'],
              'data_time' => $data['data_time'],
              'label' => $data['label'],
              'home_team_id' => $data['home_team_id'],
              'visiting_team_id' => $data['visiting_team_id'],
              'add_date'    => time()
            ],
        ];
       $result =  LiveGameSchedule::batchInsert($values)->getResult();
       return $result;
    }


}