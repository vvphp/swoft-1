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
use App\Models\Dao\LiveUserDao;

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
     *
     * @Inject()
     * @var LiveUserDao
     */
    private $LiveUserDao;

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


    /**
     * 根据 game_id查询消息列表
     * @param $game_id
     * @param $orderBy
     * @param $start
     * @param $limit
     * @return array
     */
    public function getCommentListByGameId($game_id,$orderBy=[],$start=0,$limit=50)
    {
        $userListInfo = [];
        if(empty($game_id)){
            return [];
        }
       if(empty($orderBy)){
           $orderBy = ['id' => 'DESC'];
       }
      $list = $this->LiveCommentDao->getCommentListByGameId($game_id,$orderBy,$start,$limit);
      $userIdList = array_column($list,'userId');
      if($userIdList){
         $userListInfo = $this->LiveUserDao->getUserListByIdList($userIdList);
         $userListInfo = array_column($userListInfo,'nikeName','id');
       }
      foreach($list as $index => &$item){
          $userId = $item['userId'];
          $item['date'] = date('Y-m-d H:i:s',$item['addDate']);
          $item['nickName'] = isset($userListInfo[$userId]) ? $userListInfo[$userId] : '老夫';
      }
       return $list;
    }


    /**
     * @param $game_id
     * @param $user_id
     * @param string $startTime
     * @param string $endTime
     * @return int
     */
    public function getCommentCountByGameId($game_id,$user_id,$startTime='',$endTime='')
    {
        return  $this->LiveCommentDao->getCommentCountByGameId($game_id,$user_id,$startTime,$endTime);
    }

}
