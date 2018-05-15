<?php
/**
 * 定时任务
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Tasks;

use App\Lib\DemoInterface;
use App\Models\Entity\User;
use Swoft\App;
use Swoft\Bean\Annotation\Inject;
use Swoft\HttpClient\Client;
use Swoft\Redis\Redis;
use Swoft\Rpc\Client\Bean\Annotation\Reference;
use Swoft\Task\Bean\Annotation\Scheduled;
use Swoft\Task\Bean\Annotation\Task;

/**
 * cron task
 *
 * @Task("cron")
 */
class CronTask
{
    /**
     * crontab 直播吧抓取 定时任务
     * 每一秒执行一次
     *
     * @Scheduled(cron="* * * * * *")
     */
    public function cronZhiBo8Task()
    {
        echo time() . "每一秒执行一次  \n";
        return 'cron';
    }

}
