<?php
/**
 * 直播项目，后台. 赛事控制器

 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Controllers\Admin;

use HMinng\Log\Base\Base;
use Swoft\App;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\View\Bean\Annotation\View;
use Swoft\Http\Message\Server\Response;
use Swoft\Http\Message\Server\Request;
use Swoft\Bean\Annotation\Bean;
use Swoft\Http\Message\Bean\Annotation\Middleware;
use App\Middlewares\ControllerMiddleware;
use App\Models\Logic\LiveGameLogic;
use App\Models\Logic\LiveCommentaryLogic;
use Swoft\Exception\BadMethodCallException;
use App\Common\Tool\Util;
use App\Common\Helper\Live;

/**
 * Class MatchController
 * @Controller(prefix="/admin/match")
 * @Middleware(class=ControllerMiddleware::class)
 */
class MatchController
{
    private $liveStatus = ['','未开始','正在直播','已结束'];

    /**
     * @\Swoft\Bean\Annotation\Inject("LiveHelper")
     * @var \App\Common\Helper\Live
     */
     private $LiveHelper;

    /**
     * 保存直播状态
     * @var array
     */
     private static $gameStatus = [];


    /**
     * 后台赛事列表
     * @RequestMapping();
     * @View(template="admin/match/index")
     * @param $request
     * @return Response
     */
    public function index(Request $request)
    {
        $queryArr =  $request->query();
        $page  = isset($queryArr['page']) ?  intval($queryArr['page']) : 1;
        $start = ($page-1)*10;
        /* @var LiveGameLogic $matchLogic */
        $matchLogic = App::getBean(LiveGameLogic::class);
        $data = $matchLogic->getGameListDataByWhere($queryArr,[],$start);
        return ['data' => $data,'liveStatus' => $this->liveStatus,'page' => $page];
     }

    /**
     * 开始直播
     * @RequestMapping("startLive/{game_id}");
     * @throws BadMethodCallException
     * @View(template="admin/match/startLive")     *
     * @param $request
     * @param $game_id
     * @return Response
     */
    public function startLive(Request $request,int $game_id)
    {
        if(empty($game_id)){
            throw new BadMethodCallException('非法请求!!!');
        }
        //查询比赛信息 并放入缓存
        /* @var LiveGameLogic $logic */
        $logic = App::getBean(LiveGameLogic::class);
        $data  = $logic->processGameDataById($game_id);
        return ['data' => $data,'game_id' => $game_id];
    }


    /**
     * 保存直播解说数据
     * @RequestMapping();
     * @throws BadMethodCallException      
     * @param $request      
     * @return Response
     */
    public function saveDetails(Request $request)
    {
       $data = $request->post();
       if(empty($data['game_id']) || empty($data['editorValue']) || empty($data['team_id'])){
            return Util::showMsg([],'live_add_null_data','0');
       }
        //如果未开始或已结束则不允许直接写数据
        $gameStatus = self::$gameStatus;
        $game_id    =  $data['game_id'];
        if(!isset($gameStatus[$game_id])){
            /* @var LiveGameLogic $gameLogic */
            $gameLogic = App::getBean(LiveGameLogic::class);
            $gameData = $gameLogic->getGameDataByGameId($data['game_id']);
            $gameStatus[$game_id] = isset($gameData['liveStatus']) ? $gameData['liveStatus'] : '1';
        }
        if($gameStatus[$game_id] == '3' || $gameStatus[$game_id] == '1'){
             return Util::showMsg([],'live_status_failure','0');
        }
        //写数据库
        /* @var LiveCommentaryLogic $logic */
        $logic = App::getBean(LiveCommentaryLogic::class);
        $result  = $logic->saveCommentary($data);
        if($result){
             //写websocket
             $gameUserListFd = $this->LiveHelper->getLiveUserListByGameId($game_id);
             \Swoft::$server->sendToSome($data['editorValue'],$gameUserListFd);
              return Util::showMsg([],'live_add_game_success');
        }else{
             return Util::showMsg([],'live_data_add_failure','0');
        }
    }

    /**
     * 修改直播状态
     * @param $request
     * @return json
     */
    public function setLiveStatus(Request $request)
    {
        $game_id = $request->query('game_id');
        $status  = $request->query('status');
        $liveStatus = $this->LiveHelper->getLiveStatus();
        if(empty($game_id) || empty($status) || !in_array($status,$liveStatus)){
            return Util::showMsg([],'live_set_status_error_data','0');
        }
        $data = [
            'live_status' => $status
        ];
        /* @var LiveGameLogic $gameLogic */
        $gameLogic = App::getBean(LiveGameLogic::class);
        $result = $gameLogic->updateGameDataById($game_id,$data);
        if($result){
            return Util::showMsg([],'live_set_status_success');
        }
         return Util::showMsg([],'live_set_status_error','0');
    }

    /**
     * 获取当前直播总数
     * @param $request
     * @return array
     */
    public function getLiveUserNumber(Request $request)
    {
        $game_id = $request->query('game_id');
        if(empty($game_id)){
             return Util::showMsg([],'live_null_game_id','0');
        }
        //如果未开始或已结束则直接返回0
        $gameStatus = self::$gameStatus;
        if(!isset($gameStatus[$game_id])){
            /* @var LiveGameLogic $gameLogic */
            $gameLogic = App::getBean(LiveGameLogic::class);
            $gameData = $gameLogic->getGameDataByGameId($game_id);
            $gameStatus[$game_id] = isset($gameData['liveStatus']) ? $gameData['liveStatus'] : '1';
        }
        if($gameStatus[$game_id] != '2'){
            return Util::showMsg(['count' => 0],'success');
        }
        $count = $this->LiveHelper->getLiveUserNumber($game_id);
        return Util::showMsg(['count' => $count],'success');
    }


 
}
