<?php
/**
 * 赛会表 逻辑层
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Models\Logic;

use App\Models\Entity\LiveMatchTable;

use Swoft\Bean\Annotation\Bean;
use Swoft\Rpc\Client\Bean\Annotation\Reference;

/**
 * @Bean()
 * @uses      LiveMatchLogic
 * @version   2017年10月15日
 * @author    stelin <phpcrazy@126.com>
 * @copyright Copyright 2010-2016 swoft software
 * @license   PHP Version 7.x {@link http://www.php.net/license/3_0.txt}
 */
class LiveMatchLogic
{
    /**
     * 根据 competition_name 查询是否存在，如果不存在则插入，如果存在则直接返回true
     * @param $data
     * @return bool|mixed
     */
    public function saveLiveMatch($data)
    {
        if(!empty($data['competition_name'])){
            $result = $this->getMatchIdByName($data['competition_name']);
            if(!empty($result)){
                  return $result['id'];
            }
           $ret = $this->saveMatchByData($data);
           return $ret;
        }
        return 0;
    }

    /**
     * 根据 competition_name  查询
     * @param string $competition_name
     * @return mixed
     */
    public function getMatchIdByName($competition_name='')
    {
        $where = [
            'competition_name' => $competition_name
        ];
        $result =  LiveMatchTable::findOne($where, ['fields' => ['id']])->getResult();
        if(!empty($result)){
            $result = $result->toArray();
        }
        return $result;
    }


    /**
     * 根据ID 数组查询
     * @param array $match_id_list
     * @return array
     */
    public function getMatchDataByIdList(array $match_id_list)
    {
        if(empty($match_id_list)){
            return [];
        }
        $where = [
            'id' => $match_id_list
        ];
        $fields = ['id','competition_name'];
        $result =  LiveMatchTable::findAll($where, ['fields' => $fields])->getResult();
        if(empty($result)){
              return [];
        }
        $result = $result->toArray();
        return $result;
    }



    /**
     * 插入数据
     * @param $data
     * @return mixed
     */
    public  function saveMatchByData($data)
    {
        $values = [
            [
                'competition_name'  => $data['competition_name'],
                'add_date'          => time(),
            ],
        ];
       $result =  LiveMatchTable::batchInsert($values)->getResult();
       return $result;
    }

}