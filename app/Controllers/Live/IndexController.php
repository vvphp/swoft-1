<?php
/**
 * 直播项目，首页.
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Controllers\Live;

use Swoft\App;
use Swoft\Core\Coroutine;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Message\Server\Request;
use Swoft\Log\Log;
use Swoft\View\Bean\Annotation\View;
use Swoft\Contract\Arrayable;
use Swoft\Http\Server\Exception\BadRequestException;
use Swoft\Http\Message\Server\Response;
use App\Models\Logic\LiveGameLogic;
use App\Models\Logic\LiveNewsLogic;

/**
 * Class IndexController
 * @Controller(prefix="/live")
 */
class IndexController
{

    /**
     * 赛事列表
     * @RequestMapping("/")
     * @View(template="zhibo/index/index",layout="layouts/zhibo.php")
     * @return Response
     */
    public function index()
    {
        $startDate = date('Y-m-d');
        $endDate  = date('Y-m-d',strtotime("+2 Month"));
        /* @var LiveGameLogic $logic */
        $logic = App::getBean(LiveGameLogic::class);
        $data = $logic->getGameListDataByDate($startDate,$endDate);
        /* @var LiveNewsLogic $logic */
        $logic = App::getBean(LiveNewsLogic::class);
        $videoNewsList = $logic->getNewsListByType(1,0,32);
        $textNewsList  = $logic->getNewsListByType(0,0,32);
        if($videoNewsList)
            $videoNewsList =  array_chunk($videoNewsList,16);
            $videoNewsList[0] = isset($videoNewsList[0]) ? array_chunk($videoNewsList[0],2) : [];
            $videoNewsList[1] = isset($videoNewsList[1]) ? array_chunk($videoNewsList[1],2) : [];
        if($textNewsList)
            $textNewsList = array_chunk($textNewsList,16);
            $textNewsList[0] = isset($textNewsList[0]) ? array_chunk($textNewsList[0],2) : [];
            $textNewsList[1] = isset($textNewsList[1]) ? array_chunk($textNewsList[1],2) : [];
        return ['data' => $data,'videoNewsList' => $videoNewsList,'textNewsList' => $textNewsList];
    }

    /**
     * 发送聊天
     * @param Request $request
     */
    public function sendChat(Request $request)
    {
       $post =  $request->post();
       print_r($post);
    }


}
