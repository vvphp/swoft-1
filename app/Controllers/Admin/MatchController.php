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
use Swoft\Core\Coroutine;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Log\Log;
use Swoft\View\Bean\Annotation\View;
use Swoft\Http\Server\Exception\BadRequestException;
use Swoft\Http\Message\Server\Response;
use Swoft\Http\Message\Bean\Annotation\Middleware;
use App\Middlewares\ControllerMiddleware;
use Swoft\Http\Message\Server\Request;
use App\Models\Logic\LiveAdminUserLogic;
use Swoft\Bean\Annotation\Bean;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use App\Common\Tool\Util;
use Swoft\Http\Message\Cookie\Cookie;
use Swoft\Helper\JsonHelper;
use App\Common\Helper\Login;
use App\Common\McrYpt\DES1;

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
         return [];
     }


}
