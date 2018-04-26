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
use App\Common\Sms\AliCode;


/**
 * Class SmsController
 * @Controller(prefix="/live")
 */
class SmsController
{
    /**
     * 发送短信
     * @return object
     */
    public function sendCode():object
    {
        try{
           $res = AliCode::sendSms('15201138358','1234');
        }catch(\Exception $e){
            return [$e->getCode(),$e->getMessage()];
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
