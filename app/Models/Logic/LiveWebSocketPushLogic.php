<?php
/**
 * 直播 websocket 推送消息  逻辑层
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Models\Logic;

use Swoft\Bean\Annotation\Bean;
use Swoft\Rpc\Client\Bean\Annotation\Reference;
use Swoft\Bean\Annotation\Inject;
use App\Common\Helper\Live;

/**
 *
 * @Bean()
 * @uses      LiveWebSocketPushLogic
 * @version   2018年05月22日
 * @author    zxr <strive965432@gmail.com>
 * @copyright Copyright 2010-2016 swoft software
 * @license   PHP Version 7.x {@link http://www.php.net/license/3_0.txt}
 */
class LiveWebSocketPushLogic
{

    /**
     * @\Swoft\Bean\Annotation\Inject("LiveHelper")
     * @var \App\Common\Helper\Live
     */
    private $LiveHelper;

    /**
     * 比赛直播,websocket发送比赛详情
     * @param $game_id
     * @param $data
     * @param $type
     * @return int
     */
    public function pushMatchDetail($game_id,$data,$type)
    {
        $gameUserListFd = $this->LiveHelper->getLiveUserListByGameId($game_id);
        if(empty($gameUserListFd)){
              return 1;
        }
        $sendData    = [
            'type'            => $type,
            'content'         => $data['editorValue'],
            'team_score'      => $data['home_team_score'].'-'.$data['visiting_team_score'],
            'home_team_score' => $data['home_team_score'],
            'visiting_team_score' => $data['visiting_team_score'],
            'time_frame'          => $data['timeframe']
        ];
      return   \Swoft::$server->sendToSome(json_encode($sendData),$gameUserListFd);
    }


    /**
     * @param $game_id
     * @param $data
     * @param $type
     * @return  int
     */
    public function pushChatDetails($game_id,$data,$type)
    {
        $gameUserListFd = $this->LiveHelper->getLiveUserListByGameId($game_id);
        if(empty($gameUserListFd)){
            return 1;
        }
        $sendData    = [
            'type'       => $type,
            'content'    => $data['content'],
            'nick_name'  => $data['nick_name'],
            'time'       => time(),
        ];
        return   \Swoft::$server->sendToSome(json_encode($sendData),$gameUserListFd);
    }

}
