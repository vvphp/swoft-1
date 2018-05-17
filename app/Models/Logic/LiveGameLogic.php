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

use Swoft\App;
use App\Models\Entity\LiveGameSchedule;
use App\Models\Entity\LiveMatchTable;
use Swoft\Bean\Annotation\Bean;
use Swoft\Rpc\Client\Bean\Annotation\Reference;
use App\Models\Logic\LiveMatchLogic;

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


    /**
     * 根据时间段查询赛事数据
     * @param $startDate
     * @param $endDate
     * @return array|mixed
     */
    public function getGameDataByDate($startDate,$endDate)
    {
        $where = [
            'game_date','between',$startDate,$endDate
        ];
        $fields = ['id','match_id','game_date','data_time','label','home_team_id','visiting_team_id','live_status'];
        $result = LiveGameSchedule::findAll($where, ['fields' => $fields,'orderby' => ['id' => 'ASC']])->getResult();
        if(empty($result)){
              return [];
        }
        $result = $result->toArray();
        return $result;
    }

    /**
     * 查询赛事列表数据
     * @return array
     */
    public function getGameData()
    {
        $currDate = date('Y-m-d');
        $endDate  = date('Y-m-d',strtotime("+2 Month"));
        $result = $this->getGameDataByDate($currDate,$endDate);
        $match_id_list = array_column($result,'matchId');
        $team_id_list  = array_column($result,'homeTeamId');
        $game_id_list  = array_column($result,'id');
        $team_id_list  = array_merge($team_id_list,array_column($result,'visitingTeamId'));

        $match_id_list = array_unique($match_id_list);
        $match_id_list = array_filter($match_id_list);

        $team_id_list = array_unique($team_id_list);
        $team_id_list = array_filter($team_id_list);

        /* @var LiveMatchLogic $matchLogic */
        $matchLogic = App::getBean(LiveMatchLogic::class);
        $matchData =  $matchLogic->getMatchDataByIdList($match_id_list);

        /* @var LiveTeamLogic $teamLogic */
        $teamLogic = App::getBean(LiveTeamLogic::class);
        $teamData = $teamLogic->getTeamDataByIdList($team_id_list);

        /* @var LivePlayLogic $playLogic */
        $playLogic = App::getBean(LivePlayLogic::class);
        $playData =  $playLogic->getPlayDataByIdList($game_id_list);

        $data =  $this->processGameData($result,$matchData,$teamData,$playData);
        return $data;
    }


    /**
     * 整理赛事列表数据
     * @param $gameData
     * @param $matchData
     * @param $teamData
     * @param $playData
     * @return array  $data
     */
    public function processGameData($gameData,$matchData,$teamData,$playData)
    {
        $data = [];
        $teamList = [];
        $playList = [];
        $matchList = array_column($matchData,'competitionName','id');
        foreach($teamData as $key => $value){
            $teamId = $value['id'];
            $teamList[$teamId] = $value;
        }
        foreach($playData as $key => $value){
            $game_id = $value['gameId'];
            $playList[$game_id][] = $value;
        }
        foreach($gameData as $index => $item ){
            $gameId = $item['id'];
            $matchId = $item['matchId'];
            $home_team_id = $item['homeTeamId'];
            $visiting_team_id = $item['visitingTeamId'];
            $data[$gameId] = $item;
            $data[$gameId]['competition_name'] = isset($matchList[$matchId]) ? $matchList[$matchId] : '';
            $data[$gameId]['home_team'] = isset($teamList[$home_team_id]) ? $teamList[$home_team_id] : [];
            $data[$gameId]['visiting_team'] = isset($teamList[$visiting_team_id]) ? $teamList[$visiting_team_id] : [];
            $data[$gameId]['play_links'] = isset($playList[$gameId]) ? $playList[$gameId] : [];
        }
        $reData = [];
        foreach($data as $index => $item){
              $gameDate = $item['gameDate'];
              $reData[$gameDate][] = $item;
        }

        unset($teamData,$matchData,$playData,$gameData);
        return $data;
    }

}