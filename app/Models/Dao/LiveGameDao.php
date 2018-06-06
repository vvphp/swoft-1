<?php
/**
 * 赛程表 MODEL层
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Models\Dao;

use Swoft\App;
use App\Models\Entity\LiveGameSchedule;
use Swoft\Bean\Annotation\Bean;
use Swoft\Db\QueryBuilder;
use Swoft\Rpc\Client\Bean\Annotation\Reference;
use App\Models\Dao\LiveTeamDao;
use Swoft\Bean\Annotation\Inject;
use Swoft\Db\Db;
use Swoft\Db\Query;


/**
 * @Bean()
 * @uses      LiveGameDao
 * @version   2017年10月15日
 * @author    stelin <phpcrazy@126.com>
 * @copyright Copyright 2010-2016 swoft software
 * @license   PHP Version 7.x {@link http://www.php.net/license/3_0.txt}
 */
class LiveGameDao
{
    private  $fields = ['id','live_member_id','match_id','game_date','data_time','label','home_team_id','visiting_team_id','live_status'];

    private  $reNameFields = ['id','live_member_id' => 'liveMemberId','match_id' => 'matchId','game_date' => 'gameDate',
        'home_team_id' => 'homeTeamId','visiting_team_id' => 'visitingTeamId','live_status' => 'liveStatus',
        'label','data_time' => 'dataTime'];

    /**
     *
     * @Inject()
     * @var LiveTeamDao
     */
    private  $liveTeamDao;


    /**
     * 先判断是否存在，如果不存在则插入，如果存在则直接返回true
     * @param $data
     * @return bool|mixed
     */
    public function saveLiveGame($data)
    {
        $result = $this->getGameIdByWhere($data);
        return  !empty($result) ? $result['id'] : $this->saveGameByData($data);
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
     * 修改赛事数据
     * @param $game_id
     * @param $data
     * @return boolean
     */
    public function updateGameDataById($game_id,$data)
    {
        return  LiveGameSchedule::updateOne($data, ['id' => $game_id])->getResult();
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
       if(isset($where['visiting_team_id']) && isset($where['home_team_id']) && $where['home_team_id'] == $where['visiting_team_id']){
            $home_team_id = $where['home_team_id'];
            unset($where['home_team_id'],$where['visiting_team_id']);
            $result =  Query::table(LiveGameSchedule::class)->whereIn('home_team_id',$home_team_id)->whereIn('visiting_team_id',$home_team_id,QueryBuilder::LOGICAL_OR)->condition($where)->get($this->reNameFields)->getResult();
            return $result;
       }else{
          $result = LiveGameSchedule::findAll($where, ['fields' => $this->fields,'orderby' => $orderBy,'offset'=>$start,'limit' => $limit])->getResult();
          return  empty($result) ? [] : $result->toArray();
       }
    }

    /**
     * 根据条件返回总数
     * @param $where
     * @return array
     */
    public function getGameCountByWhere($where)
    {
        $where = $this->getWhere($where);
        if(isset($where['visiting_team_id']) && isset($where['home_team_id']) && $where['home_team_id'] == $where['visiting_team_id']){
            $home_team_id = $where['home_team_id'];
            unset($where['home_team_id'],$where['visiting_team_id']);
            $result =  Query::table(LiveGameSchedule::class)->whereIn('home_team_id',$home_team_id)->whereIn('visiting_team_id',$home_team_id,QueryBuilder::LOGICAL_OR)->condition($where)->count('id')->getResult();
            return $result;
        }
        return  LiveGameSchedule::count('id',$where)->getResult();
    }



    /**
     * 根据ID 查询赛事信息
     * @param int $game_id
     * @return array
     */
    public function getGameDataByGameId(int $game_id)
    {
        return  $this->getGameIdByWhere([ 'id' => $game_id ],$this->fields);
    }



    /**
     * 绑定where 条件 针对一些特殊条件
     * @param $where
     * @return mixed
     */
    private function buildWhere($where)
    {
        $gameName  = isset($where['gameName']) ? trim($where['gameName']) : '';
        $startDate = isset($where['startDate']) ? trim($where['startDate']) : '';
        $endDate   = isset($where['endDate'])  ? trim($where['endDate']) : '';
        $teamIdList = [];
        if(!empty($gameName)){
            $teamIdList = $this->liveTeamDao->getTeamIdByName($gameName,'like');
            $teamIdList = array_column($teamIdList,'id');
        }
        if(!empty($teamIdList)){
            $where['home_team_id'] = $teamIdList;
            $where['visiting_team_id'] = $teamIdList;
            unset($where['gameName']);
        }
        if(!empty($startDate) && !empty($endDate)){
            $where['betweenDate'] = ['startDate' => $startDate, 'endDate' => $endDate];
            unset($where['startDate'],$where['endDate']);
        }
        if(!empty($startDate) && empty($endDate)){
             $where['game_date'] = $startDate;
        }
        if(empty($startDate) && !empty($endDate)){
            $where['game_date'] = $endDate;
        }
        return $where;
    }

    /**
     * 获取条件
     * @param $where
     * @return array
     */
    public function getWhere($where)
    {
        $filter = [];
        $where = $this->buildWhere($where);
        if(isset($where['id'])){
            $filter['id'] = $where['id'];
        }
        if(isset($where['match_id'])){
            $filter['match_id'] = $where['match_id'];
        }
        if(isset($where['game_date'])){
            $filter['game_date'] = $where['game_date'];
        }
        if(isset($where['data_time'])){
            $filter['data_time'] = $where['data_time'];
        }
        if(isset($where['home_team_id'])){
            $filter['home_team_id'] = $where['home_team_id'];
        }
        if(isset($where['visiting_team_id'])){
             $filter['visiting_team_id'] = $where['visiting_team_id'];
        }
        if(isset($where['betweenDate'])){
            $filter[] = ['game_date','between',$where['betweenDate']['startDate'],$where['betweenDate']['endDate']];
        }
        return $filter;
    }

}