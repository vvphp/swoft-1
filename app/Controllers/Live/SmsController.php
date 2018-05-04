<?php
/**
 * 直播项目，短信发送.
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
use Swoft\Http\Message\Server\Response;
use Swoft\Cache\Cache;
use Swoft\Bean\Annotation\Inject;
use Swoft\Http\Message\Server\Request;
use App\Common\Tool\Util;


/**
 * Class SmsController
 * @Controller(prefix="/live/sms")
 */
class SmsController extends BaseController
{

    /**
     * @\Swoft\Bean\Annotation\Inject("SendCode")
     * @var \App\Common\Sms\SendCode
     */
      private $sendCode;

    /**
     * 发送短信
     * @return object
     */
    public function sendCode(Request $request)
    {
        try{
            $phone = $request->post('phone');
            $token = $request->post('token','token');
            $this->sendCode->sendSms($phone,$token);
         }catch(\Exception $e){
             return Util::showMsg(['msg' => $e->getMessage()],'error','0');
        }
        return Util::showMsg(['msg' => Util::getMsg('smsSendSuccess')]);
    }

}
