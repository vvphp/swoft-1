<?php
/**
 * 直播项目，详情.
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Controllers\Live;

use App\Common\Tool\Valitron;
use App\Lib\Valitron\Validator;
use Swoft\App;
use Swoft\Core\Coroutine;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Log\Log;
use Swoft\View\Bean\Annotation\View;
use Swoft\Contract\Arrayable;
use Swoft\Http\Server\Exception\BadRequestException;

use Swoft\Bean\Annotation\Integer;
use Swoft\Bean\Annotation\ValidatorFrom;
use Swoft\Http\Message\Server\Response;
use Swoft\Http\Message\Server\Request;
use Swoft\Exception\BadMethodCallException;

/**
 * Class GameController
 * @Controller(prefix="/game")
 */
class GameController
{

    /**
     * 文字直播
     * @RequestMapping("wenzi/detail/{game_id}")
     * @throws BadMethodCallException
     * @View(template="live/game/wenziDetail",layout="layouts/live.php")
     * @param Request $request
     * @param int     $game_id
     * @return Response
     */
    public function wenziDetail(Request $request,int $game_id)
    {
        if(empty($game_id)){
            throw new BadMethodCallException('非法请求!!!');
        }

        //查询比赛信息 并放入缓存

        //连接websocket

        //websocket push


        echo  $game_id;
    }

}
