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
 * @Controller(prefix="/live/login")
 */
class LoginController
{
    /**
     * @RequestMapping(route="/")
     * @View(template="live/login/login",layout="layouts/live.php")
     * @return array
     */
    public function index(Request $request): array
    {
        $server = $request->getSwooleRequest()->server;
        $token = md5( $server['remote_addr']. uniqid());
        return array('token'=>$token);
    }

    /**
     * signin
     * 登录处理
     * @param Request $request
     */
    public  function signin(Request $request)
    {
        $post = $request->post();
         print_r($post);
    }

}
