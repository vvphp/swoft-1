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
use Swoft\Contract\Arrayable;
use Swoft\Http\Server\Exception\BadRequestException;
use Swoft\Http\Message\Server\Response;
use Swoft\Bean\Annotation\Inject;
use Swoft\Http\Message\Server\Request;
use App\Models\Logic\LiveCodeLogic;


/**
 * Class SmsController
 * @Controller(prefix="/live/code")
 */
class CodeController extends BaseController
{

    /**
     * 发送短信
     * @param $request
     * @return object
     */
    public function sendSmsCode(Request $request)
    {
        $phone = $request->post('phone');
        $token = $request->post('token','token');
        /* @var LiveCodeLogic $logic */
        $logic = App::getBean(LiveCodeLogic::class);
        $return =  $logic->sendRegisterCode($phone,$token);
        return $return;
    }


}
