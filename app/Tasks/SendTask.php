<?php
/**
 * 发送任务 TASK
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Tasks;

use App\Lib\DemoInterface;
use App\Models\Entity\User;
use phpDocumentor\Reflection\Types\Boolean;
use Swoft\App;
use Swoft\Bean\Annotation\Inject;
use Swoft\HttpClient\Client;
use Swoft\Redis\Redis;
use Swoft\Rpc\Client\Bean\Annotation\Reference;
use Swoft\Task\Bean\Annotation\Scheduled;
use Swoft\Task\Bean\Annotation\Task;
use App\Common\Sms\AliCode;

/**
 * Send task
 *
 * @Task("send")
 */
class SendTask
{
    /**
     * 发送短信 task
     * @param $phone
     * @param $code
     * @return Boolean
     */
    public function sendSms($phone,$code)
    {
        if(empty($phone) || empty($code)){
            return false;
        }
        $res = AliCode::sendSms($phone,$code);
        if(is_object($res) && $res->Code == 'OK'){
              return true;
        }else{
             return false;
        }
    }



}
