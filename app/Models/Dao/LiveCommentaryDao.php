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
    private  $fields = ['id','game_id','content','time_frame','add_date','team_id'];

    /**
     * 根据 game_id 查询表中解说信息
     * @param int $game_id
     * @param int $start
     * @param int $limit
     * @return mixed
     */
    public function getCommentaryByGameId(int $game_id,int $start = 0,int $limit=50)
    {
        $where = [
                  'game_id' => $game_id
                 ];
        $result =  LiveCommentary::findAll($where, [
                                                    'fields'  => $this->fields,
                                                    'orderby' => ['id' => 'DESC'],
                                                    'offset'  => $start,
                                                    'limit'   => $limit
                                                  ]
        )->getResult();
        return empty($result) ? [] : $result->toArray();
    }


    /**
     * 保存解说详情数据
     * @param array $data
     * @return bool|mixed
     */
    public function saveCommentary($data)
    {
        $values = [
            [
              'game_id'   => $data['game_id'],
              'content'   => $data['editorValue'],
              'time_frame' => $data['timeframe'],
              'team_id'   => $data['team_id'],
              'add_date'  => time()
            ],
        ];
        return  LiveCommentary::batchInsert($values)->getResult();
    }

}