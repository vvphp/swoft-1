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


/**
 * Class SmsController
 * @Controller(prefix="/live")
 */
class SmsController
{
    /**
     * 发送短信
     * @return array
     */
    public function sendCode():array
    {
        $settings = App::$properties['sms'];
        return $settings;


//        $response = Sms::sendSms();
//        echo "发送短信(sendSms)接口返回的结果:\n";
//        print_r($response);
//
//        sleep(2);

    }

}
