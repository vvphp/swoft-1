<?php
/**
 * This file is part of Swoft.
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\WebSocket;

use Swoft\Http\Message\Server\Request;
use Swoft\Http\Message\Server\Response;
use Swoft\WebSocket\Server\Bean\Annotation\WebSocket;
use Swoft\WebSocket\Server\HandlerInterface;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server;
use App\Common\Tool\Base;
use Swoft\Bean\Annotation\Inject;
use App\Common\Helper\Live;

/**
 * Class LiveController - This is an controller for handle websocket
 * @package App\WebSocket
 * @WebSocket("/live")
 */
class LiveController implements HandlerInterface
{

    /**
     * @Inject()
     * @var \Swoft\Redis\Redis
     */
    private $redis;

    /**
     * @\Swoft\Bean\Annotation\Inject("LiveHelper")
     * @var \App\Common\Helper\Live
     */
    private $LiveHelper;

    /**
     * 比赛ID
     * @var
     */
    private $game_id;

    /**
     * 在这里你可以验证握手的请求信息
     * - 必须返回含有两个元素的array
     *  - 第一个元素的值来决定是否进行握手
     *  - 第二个元素是response对象
     * - 可以在response设置一些自定义header,body等信息
     * @param Request $request
     * @param Response $response
     * @return array
     * [
     *  self::HANDSHAKE_OK,
     *  $response
     * ]
     */
    public function checkHandshake(Request $request, Response $response): array
    {
        $query = $request->query();
        if(isset($query['game_id']) && !empty($query['game_id'])){
               $this->game_id = $query['game_id'];
               return [self::HANDSHAKE_OK, $response];
        }else{
               return [self::HANDSHAKE_FAIL, $response];
         }
    }

    /**
     * @param Server $server
     * @param Request $request
     * @param int $fd
     * @return mixed
     */
    public function onOpen(Server $server, Request $request, int $fd)
    {
         $key = $this->LiveHelper->getLiveUserKey($this->game_id);
         $this->redis->sAdd($key,$fd);
        // $server->push($fd, 'hello, welcome! :)');
    }

    /**
     * @param Server $server
     * @param Frame $frame
     * @return mixed
     */
    public function onMessage(Server $server, Frame $frame)
    {
         // $server->push($frame->fd, 'hello, I have received your message: ' . $frame->data);
    }

    /**
     * @param Server $server
     * @param int $fd
     * @return mixed
     */
    public function onClose(Server $server, int $fd)
    {
        $key = $this->LiveHelper->getLiveUserKey($this->game_id);
        $this->redis->sRem($key,$fd);
        // do something. eg. record log
    }

}
