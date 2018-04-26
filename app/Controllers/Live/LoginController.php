<?php
/**
 * 直播项目，登录页.
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
use Swoft\Log\Log;
use Swoft\View\Bean\Annotation\View;
use Swoft\Contract\Arrayable;
use Swoft\Http\Server\Exception\BadRequestException;
use Swoft\Http\Message\Server\Request;

/**
 * Class IndexController
 * @Controller(prefix="/live")
 */
class LoginController
{
    /**
     * @RequestMapping(route="login")
     * @View(template="live/login/login",layout="layouts/live.php")
     * @return array
     */
    public function login(Request $request): array
    {
        $server = $request->getSwooleRequest()->server;
        $ip = $server['remote_addr'];
        $token = md5($ip. uniqid());
        return array($token);
    }

}
