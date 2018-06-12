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
use App\Common\Tool\Util;
use App\Models\Logic\LiveUserLogic;
use Swoft\Http\Message\Cookie\Cookie;
use App\Common\Helper\Login;
use App\Common\McrYpt\DES1;
use Swoft\Helper\JsonHelper;
use App\Common\Tool\Valitron;


/**
 * Class UserController
 * @Controller(prefix="/live/user")
 */
class UserController
{

    /**
     * @\Swoft\Bean\Annotation\Inject("Valitron")
     * @var \App\Common\Tool\Valitron
     */
    private $valitron;


    /**
     * 用户登录模板
     * @RequestMapping();
     * @View(template="zhibo/user/login")
     * @return Response
     */
    public function login()
    {
        return [];
    }

    /**
     * 用户登录处理
     * @RequestMapping();
     * @param $request
     * @param  $response
     * @return Response
     */
    public function sigin(Request $request,Response $response)
    {
        $post = $request->post();
        $post = array_filter($post,'trim');
        $check = $this->valitron->verificationSigin($post);
        if(is_array($check)){
            $msgArr = array_pop($result);
            return Util::showMsg([],$msgArr[0],'0');
        }
        /* @var LiveUserLogic $logic */
        $logic = App::getBean(LiveUserLogic::class);
        $password = $logic->generatePassword($post['password']);
        $ret = $logic->getUserInfoByPhonePassword($post['phone'],$password);
        print_r($ret);
        if($ret){
            $userInfo = isset($ret[0]) ? $ret[0] : [];
            //update last login date
            $logic->updateLastLoginTime($userInfo['id'],time());
            //set cookie
            $loginData = JsonHelper::encode($userInfo);
            $retJson   = Util::showMsg([],'login_success');
            $cookie = new Cookie(Login::getFrontCookieName(),DES1::encrypt($loginData));
            $response->withCookie($cookie)->withContent($retJson)->send();
        }else{
            return Util::showMsg([],'login_error','0');
        }
    }

    /**
     * 注册
     * @param Request $request
     * @param Response $response
     * @return array
     */
    public function register(Request $request,Response $response)
    {
        $post = $request->post();
        $post = array_filter($post,'trim');
        $check = $this->valitron->verificationRegister($post);
        var_dump($check);
        if(is_array($check)){
            $msgArr = array_pop($result);
            return Util::showMsg([],$msgArr[0],'0');
        }
        /* @var LiveUserLogic $logic */
        $logic = App::getBean(LiveUserLogic::class);
        $post['password'] = $logic->generatePassword($post['password']);
        $userList =  $logic->getUserListByPhone($post['phone']);
        if(!empty($userList)){
            return Util::showMsg([],'register_phone_exists','0');
        }
        $userId = $logic->saveUser($post);
        var_dump($userId);
        if($userId){
            $userInfo = $logic->getUserInfoById($userId);
            //set cookie
            $loginData = JsonHelper::encode($userInfo);
            $retJson   = Util::showMsg([],'register_success');
            $cookie = new Cookie(Login::getFrontCookieName(),DES1::encrypt($loginData));
            $response->withCookie($cookie)->withContent($retJson)->send();
        }else{
            return Util::showMsg([],'register_fail','0');
        }
    }

}
