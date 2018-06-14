<?php
/**
 * 直播项目，后台.
 *
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
 * Class IndexController
 * @Controller(prefix="/admin/index")
 * @Middleware(class=ControllerMiddleware::class)
 */
class IndexController
{

    /**
     * 后台首页
     * @RequestMapping();
     * @View(template="admin/index")
     * @return Response
     */
    public function index()
    {
       return [];
    }

    /**
     * 登录页
     * @RequestMapping();
     * @View(template="admin/login")
     * @return Response
     */
    public function login()
    {
          return [];
    }

    /**
     * 登录处理
     * @RequestMapping(route="signin", method={RequestMethod::POST})
     * @return Response
     */
    public function signin(Request $request,Response $response)
    {
        $post = $request->post();
        $userName = isset($post['userName']) ? trim($post['userName']) : '';
        $passWord   = isset($post['passwd']) ? trim($post['passwd']) : '';
        if(empty($post) || empty($userName) || empty($passWord)){
            return Util::showMsg([],'login_error_empty_data','0');
        }
        $passWord  = DES1::encrypt($passWord);
        /* @var LiveAdminUserLogic $adminLogic */
        $adminLogic = App::getBean(LiveAdminUserLogic::class);
        $check = $adminLogic->checkUserByPass($userName,$passWord);
        if(empty($check)){
            return Util::showMsg([],'login_error','0');
        }
        //update last_login_date
        $adminLogic->updateUserDataById($check['id'],['last_login_date'=>time()]);
        //set cookie
        $loginData = JsonHelper::encode($check);
        $retJson = Util::showMsg([],'login_success','1');
        $cookie = new Cookie(Login::getAdminCookieName(),DES1::encrypt($loginData));
        $response->withCookie($cookie)->withContent($retJson)->send();
    }

}
