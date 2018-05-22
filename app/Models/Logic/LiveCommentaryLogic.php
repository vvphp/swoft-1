<?php
/**
 * 比赛解说详情表 逻辑层
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Models\Logic;

use App\Models\Entity\LiveCommentary;

use Swoft\Bean\Annotation\Bean;
use Swoft\Rpc\Client\Bean\Annotation\Reference;

/**
 *
 * @Bean()
 * @uses      LiveCommentaryLogic
 * @version   2018年05月22日
 * @author    zxr <strive965432@gmail.com>
 * @copyright Copyright 2010-2016 swoft software
 * @license   PHP Version 7.x {@link http://www.php.net/license/3_0.txt}
 */
class LiveCommentaryLogic
{
    /**
     * 根据 game_id 查询表中解说信息
     * @param int $game_id
     * @param int $start
     * @param int $limit
     * @return mixed
     */
    public function getCommentaryByGameId(int $game_id,int $start = 0,int $limit=50)
    {
        if(empty($game_id)){
            return [];
        }
        $where = [
            'game_id' => $game_id
        ];
        $fields = ['id','content'];
        $result =  LiveCommentary::findAll($where, ['fields'  => $fields,
                                                    'orderby' => ['id' => 'DESC'],
                                                    'offset'  => $start,
                                                    'limit'   => $limit
        ])->getResult();
        if(!empty($result)){
            $result = $result->toArray();
        }
        return $result;
    }


}