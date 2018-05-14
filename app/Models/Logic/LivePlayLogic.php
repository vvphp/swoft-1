<?php
/**
 * 播放地址表 逻辑层
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Models\Logic;
use App\Models\Entity\LivePlayLink;
use Swoft\Bean\Annotation\Bean;
use Swoft\Rpc\Client\Bean\Annotation\Reference;

/**
 * @Bean()
 * @uses      LivePlayLogic
 * @version   2017年10月15日
 * @author    stelin <phpcrazy@126.com>
 * @copyright Copyright 2010-2016 swoft software
 * @license   PHP Version 7.x {@link http://www.php.net/license/3_0.txt}
 */
class LivePlayLogic
{
    /**
     * @param $game_id
     * @param $data
     * @return bool|mixed
     */
    public function saveLivePlay($game_id,$data)
    {
        if(empty($game_id) || empty($data)){
            return 0;
        }
       foreach($data as $key => $item){
           $result = $this->getPlayIdByPlat($game_id,$item['text']);
           if(!empty($result)){
               continue;
           }
           $item['game_id'] = $game_id;
           $this->savePlayByData($item);
       }
        return true;
    }

    /**
     * 根据 game_id 和play_platform  查询
     * @param int $game_id
     * @param string $play_platform
     * @return mixed
     */
    public function getPlayIdByPlat($game_id,$play_platform)
    {
        $where = [
            'game_id' => $game_id,
            'play_platform' => $play_platform
        ];
        $result =  LivePlayLink::findOne($where, ['fields' => ['id']])->getResult();
        if(!empty($result)){
            $result = $result->toArray();
        }
        return $result;
    }

    /**
     * 插入数据
     * @param $item
     * @return mixed
     */
    public  function savePlayByData($item)
    {
        $values = [
            [
                'game_id'    => $item['game_id'],
                'play_platform' => $item['text'],
                'play_url' => $item['href'],
                'add_date'  => time()
            ],
        ];
       $result =  LivePlayLink::batchInsert($values)->getResult();
       return $result;
    }

}