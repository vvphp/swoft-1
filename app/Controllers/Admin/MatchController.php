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


/**
 * Class MatchController
 * @Controller(prefix="/admin/match")
 * @Middleware(class=ControllerMiddleware::class)
 */
class MatchController
{
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

        print_r($data);
         return ['data' => $data];
     }


}
