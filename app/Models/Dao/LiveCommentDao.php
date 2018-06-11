<?php
/**
 * 聊天记录 MODEL层 具体的数据库操作
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
use App\Models\Entity\LiveComment;

/**
 * @Bean()
 * @uses      LiveCommentDao
 * @version   2017年10月15日
 * @author    stelin <phpcrazy@126.com>
 * @copyright Copyright 2010-2016 swoft software
 * @license   PHP Version 7.x {@link http://www.php.net/license/3_0.txt}
 */
class LiveCommentDao
{

    /**
     * 保存聊天记录
     * @param int $game_id
     * @param $data
     * @return mixed
     */
    public  function saveCommentData($game_id,$data)
    {
        $values = [
             [
                'game_id'   => $game_id,
                'nick_name' => isset($data['nick_name']) ? $data['nick_name'] : '',
                'content'   => isset($data['content']) ? $data['content'] : '',
                'add_date'  => time(),
             ],
         ];
        return  LiveComment::batchInsert($values)->getResult();
    }

}