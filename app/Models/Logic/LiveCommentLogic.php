<?php
/**
 * 聊天表 逻辑层
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Models\Logic;

use App\Models\Entity\LiveComment;

use Swoft\Bean\Annotation\Bean;
use Swoft\Rpc\Client\Bean\Annotation\Reference;
use Swoft\Bean\Annotation\Inject;
use App\Models\Dao\LiveCommentDao;

/**
 *
 * @Bean()
 * @uses      LiveCommentLogic
 * @version   2017年10月15日
 * @author    stelin <phpcrazy@126.com>
 * @copyright Copyright 2010-2016 swoft software
 * @license   PHP Version 7.x {@link http://www.php.net/license/3_0.txt}
 */
class LiveCommentLogic
{

    /**
     *
     * @Inject()
     * @var LiveCommentDao
     */
    private  $LiveCommentDao;


    /**
     * 保存聊天室聊天记录
     * @param $game_id
     * @param $data
     * @return boolean
     */
    public function saveComment($game_id,$data)
    {
        if(empty($game_id) || empty($data)){
            return 0;
        }
       return   $this->LiveCommentDao->saveCommentData($game_id,$data);
    }

}