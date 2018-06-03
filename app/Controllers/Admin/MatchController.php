<?php
/**
 * 直播项目，后台. 赛事控制器

 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Controllers\Admin;

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
use Swoft\Exception\BadMethodCallException;
use App\Common\Tool\Util;


/**
 * Class MatchController
 * @Controller(prefix="/admin/match")
 * @Middleware(class=ControllerMiddleware::class)
 */
class MatchController
{
    private $liveStatus = ['','未开始','正在直播','已结束'];

    /**
     * 后台赛事列表
     * @RequestMapping();
     * @View(template="admin/match/index")
     * @return Response
     */
    public function index()
    {
        /* @var LiveGameLogic $matchLogic */
        $matchLogic = App::getBean(LiveGameLogic::class);
        $data = $matchLogic->getGameListDataByWhere();
        return ['data' => $data,'liveStatus' => $this->liveStatus];
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

        print_r($data);

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
           if(empty$data['game_id'] || empty($data['editorValue']) || empty($data['team_id'])){
            return Util::showMsg([],'live_data_add_failure','0'); 
           }
           //写数据库
            
           
           //写websocket

           print_r($data);
    }
 
}
