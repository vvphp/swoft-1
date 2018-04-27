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


/**
 * Class IndexController
 * @Controller(prefix="/live/login")
 */
class LoginController
{

    /**
     * @Inject()
     * @var \Swoft\Redis\Redis
     */
    private $redis;

    /**
     * @Inject("demoRedis")
     * @var \Swoft\Redis\Redis
     */
    private $demoRedis;



    /**
     * @RequestMapping(route="/live/login")
     * @param \Swoft\Http\Message\Server\Request $request
     * @param  \Swoft\Http\Message\Server\Response
     * @View(template="live/login/login",layout="layouts/live.php")
     * @return Response
     */
    public function index(Request $request,Response $response): Response
    {
        $token = $request->cookie('liveLoginToken');
        if(empty($token)){
            $server = $request->getSwooleRequest()->server;
            $token = md5( $server['remote_addr']. uniqid());
            $host = $request->getUri()->getHost();
            $cookie = new Cookie('liveLoginToken',$token,time()+300,'/',$host);

            $data =  array('token'=> $token);
            return view("live/login/login", $data,'layouts/live.php')->withCookie($cookie);
        }

        //设置REDIS
        $result = $this->redis->set('name', 'swoft');
        $this->demoRedis->set('hello','world');

        $data =  array('token'=> $token);
        return view("live/login/login", $data,'layouts/live.php');
    }




    /**
     * signin
     * 登录处理
     * @param Request $request
     */
    public  function signin(Request $request)
    {
        $request->cookie();
        $post = $request->post();
         return $request->getCookieParams();
        print_r($post);
    }

}
