<?php
/**
 * 直播助手类
 * Date: 2018/5/2
 * Time: 19:30
 */
namespace App\Common\Helper;

use Swoft\Cache\Cache;
use App\Common\Tool\Base;
use Swoft\Bean\Annotation\Inject;

/**
 * @\Swoft\Bean\Annotation\Bean("LiveHelper")
 */
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

    /**
     * 根据game_id 获取直播用户总数
     * @param $game_id
     * @return  int
     */
    public function getLiveUserNumber($game_id)
    {
        $key = self::getLiveUserKey($game_id);
        return $this->redis->sCard($key);
    }

    /**
     * 获取所有直播状态
     * @return array
     */
    public function getLiveStatus()
    {
       return  Base::getParameter('live_status');
    }


}
