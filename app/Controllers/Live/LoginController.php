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
use Swoft\Http\Message\Cookie\Cookie;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Log\Log;
use Swoft\View\Bean\Annotation\View;
use Swoft\Http\Server\Exception\BadRequestException;
use Swoft\Cache\Cache;
use Swoft\Bean\Annotation\Inject;
use Swoft\Http\Message\Server\Request;
use Swoft\Http\Message\Server\Response;
use Swoft\Helper\ResponseHelper;
use App\Common\Tool\Util;
/**
 * Class IndexController
 * @Controller(prefix="/live/login")
 */
class LoginController extends  BaseController
{
    /**
     * @Inject()
     * @var \Swoft\Redis\Redis
     */
    private $redis;

    /**
     * 登录时存放在COOKIE中的的Token名
     * @var string
     */
    private $loginCookie = 'liveLoginToken';

    /**
     * @RequestMapping(route="/live/login")
     * @param \Swoft\Http\Message\Server\Request $request
     * @param  \Swoft\Http\Message\Server\Response
     * @View(template="live/login/login",layout="layouts/live.php")
     * @return Response
     */
    public function index(Request $request,Response $response): Response
    {
        $token = $request->cookie($this->loginCookie);
        if(empty($token)){
            $token = Util::generatingLoginToken($request);
            $cookie = new Cookie($this->loginCookie,$token,time()+300,'/',$request->getUri()->getHost());
            $this->redis->set($token, $token,60);
            $data = array('token'=> $token);
            return view("live/login/login", $data,'layouts/live.php')->withCookie($cookie);
        }
        $data = array('token'=> $token);
        return view("live/login/login", $data,'layouts/live.php');
    }

    /**
     * signin
     * 登录处理
     * @param \Swoft\Http\Message\Server\Request $request
     * @param  \Swoft\Http\Message\Server\Response
     */
    public  function signin(Request $request,Response $response)
    { 
        $cookie = $request->cookie($this->loginCookie);
        if(empty($cookie)){
             $msg = translate('msg.emptyCookie', [], self::$language);
             $code = translate('Code.emptyCookie', [], self::$language);
             return  ResponseHelper::formatData([],$msg,$code);
        }
        $msg = translate('msg.emptyCookie', [], self::$language);
        $code = translate('Code.emptyCookie', [], self::$language);
        return  ResponseHelper::formatData([],$msg,$code);

    }


    /**
     * @RequestMapping(route="teaa")
    */
    public function testa()
    {
            echo 'adfdsfdsf';
    }

}
