<?php
/**
 * 测试文件， 测试定时任务
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
 * @Controller(prefix="/live/cron")
 */
class CronController extends BaseController
{

    /**
     * @\Swoft\Bean\Annotation\Inject("ZhiBoBa")
     * @var \App\Common\Cron\ZhiBoBa
     */
      private $zhiBoBa;

    /**
     * test
     * @return object
     */
    public function sendCode()
    {
      $result = $this->zhiBoBa->beginGrab();
      var_dump($result);
    }

}
