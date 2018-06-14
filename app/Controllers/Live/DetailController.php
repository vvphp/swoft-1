<?php
/**
 * 直播项目，详情.
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Controllers\Live;


use App\Models\Logic\LiveUserLogic;
use Swoft\App;
use Swoft\Core\Coroutine;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Log\Log;
use Swoft\View\Bean\Annotation\View;
use Swoft\Contract\Arrayable;
use Swoft\Http\Server\Exception\BadRequestException;

use Swoft\Bean\Annotation\Integer;
use Swoft\Bean\Annotation\ValidatorFrom;
use Swoft\Http\Message\Server\Response;
use Swoft\Http\Message\Server\Request;
use Swoft\Exception\BadMethodCallException;
use App\Models\Logic\LiveGameLogic;
use App\Models\Logic\LiveWebSocketPushLogic;
use App\Models\Logic\LiveCommentLogic;
use App\Common\Tool\Util;


/**
 * Class GameController
 * @Controller(prefix="/live/detail")
 */
class DetailController
{

    /**
     * 赛事ID
     * @var int
     */
    private $game_id = 0;

    /**
     * 当日对当场比赛可发送的最大聊天数
     * @var int
     */
    private $maxComment = 100;

    /**
     * 文字直播
     * @RequestMapping("wenzi/{game_id}")
     * @throws BadMethodCallException
     * @View(template="zhibo/detail/wenzi")
     * @param Request $request
     * @param int     $game_id
     * @return Response
     */
    public function wenzi(Request $request,int $game_id)
    {
        if(empty($game_id)){
            throw new BadMethodCallException('非法请求!!!');
        }
        //查询比赛信息 并放入缓存
        /* @var LiveGameLogic $logic */
        $logic = App::getBean(LiveGameLogic::class);
        $data  = $logic->processGameDataById($game_id);
        if(empty($data)){
            throw new BadMethodCallException('非法请求!!!');
        }
        $this->game_id = $game_id;
        /* @var LiveUserLogic $logic */
        $logic = App::getBean(LiveUserLogic::class);
        $userInfo = $logic->getLoginUserInfo($request);
        return [ 'data' => $data,'userInfo' => $userInfo ];
    }


    /**
     * 发送聊天
     * @param Request $request
     * @return json
     */
    public function sendChat(Request $request)
    {
        $chatContent =  $request->post('chatContent');
        $user_id     =  $request->post('user_id');
        /* @var LiveUserLogic $logic */
        $logic = App::getBean(LiveUserLogic::class);
        $userInfo = $logic->getLoginUserInfo($request);
        try{
            if(empty($chatContent))throw new \Exception('not_empty_chat_content');
            if(empty($userInfo['id']))throw new \Exception('please_login');
            if($user_id != $userInfo['id'])throw new \Exception('user_info_error');
        }catch(\Exception $e){
            return Util::showMsg([],$e->getMessage(),'0');
        }
        $data = [
            'content'   => mb_substr($chatContent,0,20),
            'user_id'   => $user_id,
            'nick_name' => $userInfo['nikeName']
        ];
        //save db
        /* @var LiveCommentLogic $logic */
        $logic = App::getBean(LiveCommentLogic::class);

        //一天同一场比赛只能发100条聊天信息
        $startTime = strtotime(date('Y-m-d').' 00:00:00');
        $endTime   = strtotime(date('Y-m-d').' 23:59:59');
        $commentCount = $logic->getCommentCountByGameId($this->game_id,$user_id,$startTime,$endTime);
        if($commentCount > $this->maxComment){
             return Util::showMsg([],'max_number_letters','0');
        }
        $ret = $logic->saveComment($this->game_id,$data);
        if($ret){
            /* @var LiveWebSocketPushLogic $logic */
            $logic = App::getBean(LiveWebSocketPushLogic::class);
            $ret  = $logic->pushChatDetails($this->game_id,$data,'chat');
        }
        return Util::showMsg(['result' => $ret],'send_success');
    }

}
