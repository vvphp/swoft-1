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

use Swoft\App;
use Swoft\Bean\Annotation\Inject;
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
     * @\Swoft\Bean\Annotation\Inject("ZhiBoBa")
     * @var \App\Common\Cron\ZhiBoBa
     */
    private $zhiBoBa;

    /**
     * crontab 直播吧抓取 定时任务
     * 每周日1点执行
     *
     * @Scheduled(cron="0 0 23 *\/7 * *")
     */
    public function cronZhiBo8Task()
    {
        echo "grab zhiboba start \r\n";
        $this->zhiBoBa->beginGrab();
        echo "grab zhiboba end \r\n";
        return true;
    }


    /**
     * crontab 直播吧新闻抓取 定时任务
     * 每10分钟执行
     *
     * @Scheduled(cron="0 *\/10 * * * *")
     */
    public function cronZhiBo8NewsTask()
    {
        echo "grab zhiboba news start \r\n";
        $result = $this->zhiBoBa->beginGrabNews();
        echo "共抓取".$result."条新闻";
        echo "grab zhiboba news end \r\n";
        return true;
    }


}
