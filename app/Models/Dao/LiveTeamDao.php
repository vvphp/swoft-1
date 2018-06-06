<?php
/**
 * 球队表 MODEL层 具体的数据库操作
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
use App\Models\Entity\LiveTeamTable;

/**
 * @Bean()
 * @uses      LiveTeamDao
 * @version   2017年10月15日
 * @author    stelin <phpcrazy@126.com>
 * @copyright Copyright 2010-2016 swoft software
 * @license   PHP Version 7.x {@link http://www.php.net/license/3_0.txt}
 */
class LiveTeamDao
{
    private  $fields = ['id','team_name','team_logo','sports_category','add_date'];

    /**
     * 根据 team_name查询是否存在，如果不存在则插入，如果存在则直接返回true
     * @param $data
     * @return bool|mixed
     */
    public function saveLiveTeam($data)
    {
        if(!empty($data['team_name'])){
            $result = $this->getTeamIdByName($data['team_name']);
            if(!empty($result)){
                 return $result[0]['id'];
            }
           return  $this->saveTeamByData($data);
        }
        return 0;
    }

    /**
     * 根据 team_name 查询表中是否已经存在数据
     * @param string $team_name
     * @param string $symbol
     * @return mixed
     */
    public function getTeamIdByName($team_name='',$symbol='')
    {
        if($symbol == 'like'){
            $where = ['team_name', 'like', "'%".$team_name."%'"];
        }else{
            $where = ['team_name' => $team_name];
        }
        $result =  LiveTeamTable::findAll($where, ['fields' => ['id']])->getResult();
        return empty($result) ? [] : $result->toArray();
    }

    /**
     * 根据ID 数组查询
     * @param array $team_id_list
     * @return array
     */
    public function getTeamDataByIdList(array $team_id_list)
    {
        $where  = ['id' => $team_id_list];
        $fields = ['id','team_name','team_logo'];
        $result =  LiveTeamTable::findAll($where, ['fields' => $fields])->getResult();
        return empty($result) ? [] : $result->toArray();
    }

    /**
     * 插入数据
     * @param $data
     * @return mixed
     */
    public  function saveTeamByData($data)
    {
        $values = [
             [
                'team_name'         => isset($data['team_name']) ? trim($data['team_name']) : '',
                'team_logo'         => isset($data['team_logo']) ? $data['team_logo'] : '',
                'sports_category'   => isset($data['sports_category']) ? $data['sports_category'] : '',
                'add_date'          => time(),
             ],
         ];
        return  LiveTeamTable::batchInsert($values)->getResult();
    }

}