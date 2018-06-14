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
use Swoft\Bean\Annotation\Inject;
use App\Models\Dao\LiveCommentaryDao;

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
     *
     * @Inject()
     * @var LiveCommentaryDao
     */
     private  $LiveCommentAryDao;


    /**
     * 根据 game_id 查询表中解说信息
     * @param int $game_id
     * @param int $start
     * @param int $limit
     * @return mixed
     */
    public function getCommentaryByGameId(int $game_id,int $start = 0,int $limit=80)
    {
        if(empty($game_id)){
            return [];
        }
        return  $this->LiveCommentAryDao->getCommentaryByGameId($game_id,$start,$limit);
    }


    /**
     * [saveCommentary 保存解说详情]
     * @param  [type] $data    [description]
     * @return [type]          [description]
     */
    public function saveCommentary($data)
    {
        if(empty($data)){
            return false;
        }
       return  $this->LiveCommentAryDao->saveCommentary($data);
    }


}