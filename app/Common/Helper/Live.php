<?php
/**
 * 直播助手类
 * Date: 2018/5/2
 * Time: 19:30
 */
namespace App\Common\Helper;
use Swoft\App;
use Psr\Http\Message\ServerRequestInterface;
use App\Common\Tool\Base;
use Swoft\Bean\Annotation\Inject;

class  Live
{
    /**
     * @Inject()
     * @var \Swoft\Redis\Redis
     */
    private $redis;
 
    /**
     * 获取用户集合的 redis key
     * @param int $game_id
     * @return string
     */
    public static function getLiveUserKey($game_id)
    {
        $key = Base::getRedisKey('live_game_detail_users');
        if(!empty($key)){
            $key = sprintf($key,$game_id);
        }
        return $key;
    }

    /**
     * 根据game_id 获取连接列表
     * @param $game_id
     * @return array
     */
    public function getLiveUserListByGameId($game_id)
    {
        $key = self::getLiveUserKey($game_id);
        return  $this->redis->smembers($key);
    }


}
