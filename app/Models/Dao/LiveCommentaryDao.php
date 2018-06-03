<?php
/**
 * 解说详情表 MODEL层
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Models\Dao;

use Swoft\App;
use App\Models\Entity\LiveGameSchedule;
use App\Models\Entity\LiveCommentary;
use Swoft\Bean\Annotation\Bean;
use Swoft\Rpc\Client\Bean\Annotation\Reference;
use App\Models\Logic\LiveMatchLogic;
use App\Models\Logic\LiveAdminUserLogic;
use App\Models\Logic\LiveCommentaryLogic;

/**
 * @Bean()
 * @uses      LiveCommentaryDao
 * @version   2017年10月15日
 * @author    stelin <phpcrazy@126.com>
 * @copyright Copyright 2010-2016 swoft software
 * @license   PHP Version 7.x {@link http://www.php.net/license/3_0.txt}
 */
class LiveCommentaryDao
{
    private  $fields = ['id','live_member_id','match_id','game_date','data_time','label','home_team_id','visiting_team_id','live_status'];


    /**
     * 保存解说详情数据
     * @param $game_id
     * @param $data
     * @return bool|mixed
     */
    public function saveCommentary($game_id,$data)
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
        return  LiveCommentary::batchInsert($values)->getResult();
    }






    






    /**
     * 根据 $where 条件 查询
     * @param array $where
     * @param array $fields
     * @return mixed
     */
    public function getGameIdByWhere($where,$fields=[])
    {
        $filter =  $this->getWhere($where);
        $fields =  empty($fields) ? ['id'] : $fields;
        $result =  LiveGameSchedule::findOne($filter, ['fields' => $fields ])->getResult();
        $result =  empty($result) ? [] : $result->toArray();
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
        return  LiveGameSchedule::batchInsert($values)->getResult();
    }

    /**
     * 根据时间段查询赛事数据
     * @param $startDate
     * @param $endDate
     * @return array|mixed
     */
    public function getGameDataByDate($startDate,$endDate)
    {
        $where  = ['game_date','between',$startDate,$endDate];
        $result = LiveGameSchedule::findAll($where, ['fields' => $this->fields,'orderby' => ['game_date' => 'ASC','data_time' => 'ASC']])->getResult();
        $result = empty($result) ? [] : $result->toArray();
        return $result;
    }

    /**
     * 根据条件返回数据，带排序和分页
     * @param array $where
     * @param array $orderBy
     * @param $start
     * @param $limit
     * @return array
     */
    public function getGameListDataByWhere($where,$orderBy=[],$start = 0,$limit = 10)
    {
       $where = $this->getWhere($where);
       $result = LiveGameSchedule::findAll($where, ['fields' => $this->fields,'orderby' => $orderBy,'offset'=>$start,'limit' => $limit])->getResult();
       return  empty($result) ? [] : $result->toArray();
    }

    /**
     * 根据条件返回总数
     * @param $where
     * @return array
     */
    public function getGameCountByWhere($where)
    {
        $where = $this->getWhere($where);
        return  LiveGameSchedule::count('id',$where)->getResult();
    }



    /**
     * 根据ID 查询赛事信息
     * @param int $game_id
     * @return array
     */
    public function getGameDataByGameId(int $game_id)
    {
        $where  = [ 'id' => $game_id ];
        $fields = ['id','match_id','live_member_id','game_date','data_time','label','home_team_id','visiting_team_id','live_status'];
        return  $this->getGameIdByWhere($where,$fields);
    }

    /**
     * 获取条件
     * @param $where
     * @return array
     */
    public function getWhere($where)
    {
        $filter = [];
        if(isset($where['id'])){
            $filter[ 'id'] = $where['id'];
        }
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
        return $filter;
    }


}