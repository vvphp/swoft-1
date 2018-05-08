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
use Swoft\Bean\Annotation\Strings;
use Swoft\Bean\Annotation\ValidatorFrom;
use App\Common\Tool\Valitron;
use App\Common\Tool\Util;
use Swoft\Helper\JsonHelper;
/**
 * Class IndexController
 * @Controller(prefix="/live/login")
 */
class LoginController extends  BaseController
{

    /**
     * @\Swoft\Bean\Annotation\Inject("Token")
     * @var \App\Common\Tool\Token
     */
    private $token;

    /**
     * @\Swoft\Bean\Annotation\Inject("Valitron")
     * @var \App\Common\Tool\Valitron
     */
    private $valitron;

    /**
     * @\Swoft\Bean\Annotation\Inject("SendCode")
     * @var \App\Common\Tool\SendCode
     */
    private $sendCode;

    private $cookieUserKey = 'userLoginInfo';


    /**
     * @RequestMapping(route="/live/login")
     * @param \Swoft\Http\Message\Server\Request $request
     * @View(template="live/login/login",layout="layouts/live.php")
     * @return Response
     */
    public function index(Request $request): Response
    {
        $token = $this->token->getCookie($request);
        if(empty($token)){
            $token = $this->token->generatingLoginToken($request);
            $data = array('token'=> $token);
            $cookie = $this->token->saveToken($token,$request);
            return view("live/login/login", $data,'layouts/live.php')->withCookie($cookie);
        }
        $data = array('token'=> $token);
        return view("live/login/login", $data,'layouts/live.php');
    }

    /**
     * signin
     * 登录处理
     * @param \Swoft\Http\Message\Server\Request $request
     * @param  \Swoft\Http\Message\Server\Response $response
     * @return  Response
     */
    public  function signin(Request $request,Response $response)
    {
        try{
            $data = $request->post();
            $field = ['phone_num','code','token'];
            $result = $this->valitron->valitronSignin($data,$field,$request);
            if(is_array($result)){
                $msgArr = array_pop($result);
                throw new \Exception($msgArr[0] ?? '' );
            }
           if($result == false){ 
                  throw new \Exception(Util::getMsg('login_token_error') ?? '' );
             }
           $result = $this->sendCode->comparisonCode($data['phone_num'],$data['code']); 
           if($result == false ){
               throw new \Exception(Util::getMsg('login_verify_error') ?? '' );
           }
           //删除token,删除code,
           $this->sendCode->delRedisCode($data['phone_num']);
           $this->token->delToken($data['token']);
           $loginData = [
                'is_login' => 1,
                'phone_num' => $data['phone_num'],
                'login_time' => time()
            ];
            $json = Util::showMsg($loginData,'success','1');
            $cookie = new Cookie($this->cookieUserKey,JsonHelper::encode($loginData),time()+3600,'/',$request->getUri()->getHost());
            return  $response->withContent($json)->withCookie($cookie)->send();
        }catch(\Exception $e){
             return Util::showMsg(['msg' => $e->getMessage()],'error','0');
        } 
    }

    /**
     * 登录成功后，记录cookie
     * @param Request $request
     * @param Response $response
     */
    public function siginCookie(Request $request,Response $response)
    {

       return  $response->json()->withCookie();

    }


}
