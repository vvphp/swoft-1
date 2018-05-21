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

/**
 * Class GameController
 * @Controller(prefix="/game")
 */
class GameController
{

    /**
     * 文字直播
     * @RequestMapping("wenzi/detail/{game_id}")
     *
     * @Integer(from=ValidatorFrom::GET, name="game_id", min=1, max=10000, default=0)
     *
     * @param Request $request
     * @param int     $game_id
     * @return Response
     */
    public function wenziDetail(Request $request,int $game_id)
    {
        $game_id  = $request->query('game_id');
        echo  $game_id;
    }

}
