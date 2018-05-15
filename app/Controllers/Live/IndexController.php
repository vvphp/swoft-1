<?php
/**
 * 直播项目，首页.
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
 * Class IndexController
 * @Controller(prefix="/live")
 */
class IndexController
{

    /**
     * 赛事列表
     * @RequestMapping("/")
     * @View(template="live/index/index",layout="layouts/live.php")
     * @return Response
     */
    public function index()
    {
        $data = [];
        return $data;
    }

}
