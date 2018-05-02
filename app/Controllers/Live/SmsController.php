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
use App\Common\Sms\AliCode;
use App\Common\Tool\Valitron;
use Swoft\Http\Message\Server\Request;
use App\Common\Tool\Util;
use App\Common\Verifcode\Code;


/**
 * Class SmsController
 * @Controller(prefix="/live/sms")
 */
class SmsController extends BaseController
{
    /**
     * @Inject()
     * @var \Swoft\Redis\Redis
     */
    private $redis;

    /**
     * 发送短信
     * @return object
     */
    public function sendCode(Request $request)
    {
        try{
            $codeObj = new Code();
            $phone = $request->post('phone');
            $token = $request->post('token','');
            $data = ['phone' => $phone,'token'=>$token];
            $result = Valitron::valitronSendSms($data,['phone','token']);
            var_dump($result);
            if(is_array($result)){
                throw new \Exception( array_pop($result));
            }
           //check redis token
           $countCheck =  $codeObj->sendBeforeCheck($phone);
           if($countCheck == false){
                throw new \Exception( Util::getMsg('smsSendLimit'));
            }
           $getToken =  $this->redis->get($token);
           $check = Valitron::valitronEquals($getToken,$token);
           if($check == false){
               throw new \Exception( Util::getMsg('Infoexpired'));
           }
           //看上一次发送短信的时间是否已经大于5分钟,不大于5分钟、还是用之前的验证码
           $oldCode = $codeObj->getMemberCode($phone);
            if(!empty($oldCode)){
                 $code = $oldCode;
            }else{
              $code = Code::generatingVerificationCode();
            }
            $res = AliCode::sendSms($phone,$code);
            var_dump($res);
            Code::saveRedisCode($phone,$code);
         }catch(\Exception $e){
             return Util::showMsg(['msg' => $e->getMessage(),'code' => $e->getCode()],'emptyData',self::$language);
        }
        return $res;


        /*
         *
// 调用示例：
set_time_limit(0);
header('Content-Type: text/plain; charset=utf-8');

$response = SmsDemo::sendSms();
echo "发送短信(sendSms)接口返回的结果:\n";
print_r($response);

sleep(2);

$response = SmsDemo::sendBatchSms();
echo "批量发送短信(sendBatchSms)接口返回的结果:\n";
print_r($response);

sleep(2);

$response = SmsDemo::querySendDetails();
echo "查询短信发送情况(querySendDetails)接口返回的结果:\n";
print_r($response);
         * */
//        $response = Sms::sendSms();
//        echo "发送短信(sendSms)接口返回的结果:\n";
//        print_r($response);
//
//        sleep(2);

    }

}
