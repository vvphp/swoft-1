<?php
/**
 * 直播项目，后台.
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Controllers\Admin;

use Swoft\App;
use Swoft\Core\Coroutine;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Log\Log;
use Swoft\View\Bean\Annotation\View;
use Swoft\Contract\Arrayable;
use Swoft\Http\Server\Exception\BadRequestException;
use Swoft\Http\Message\Server\Response;
use App\Models\Logic\LiveGameLogic;

/**
 * Class IndexController
 * @Controller(prefix="/admin")
 */
class IndexController
{

    /**
     * 赛事列表
     * @View(template="admin/index")
     * @return Response
     */
    public function index()
    {
        /* @var LiveGameLogic $logic */
        $logic = App::getBean(LiveGameLogic::class);
        $data = $logic->getGameListData();
        return ['data' => $data];
    }

}
