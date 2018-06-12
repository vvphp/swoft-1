<?php
/**
 * 直播项目，用户相关.
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
 * Class UserController
 * @Controller(prefix="/live/user")
 */
class UserController
{

    /**
     * 用户登录
     * @RequestMapping();
     * @View(template="zhibo/user/login")
     * @return Response
     */
    public function login()
    {
        return [];
    }



}
