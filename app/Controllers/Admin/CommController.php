<?php
/**
 * 直播项目，后台. 公共方法控制器

 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Controllers\Admin;

use HMinng\Log\Base\Base;
use Swoft\App;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\View\Bean\Annotation\View;
use Swoft\Http\Message\Server\Response;
use Swoft\Http\Message\Server\Request;
use Swoft\Bean\Annotation\Bean;
use Swoft\Http\Message\Bean\Annotation\Middleware;
use App\Middlewares\ControllerMiddleware;
use Swoft\Exception\BadMethodCallException;

/**
 * Class MatchController
 * @Controller(prefix="/admin/comm")
 * @Middleware(class=ControllerMiddleware::class)
 */
class CommController
{

    /**
     * 上传图片文件
     * @RequestMapping();
     * @throws BadMethodCallException
     * @param $request
     * @return Response
     */
    public function uploadFile(Request $request)
    {
        print_r($request);
    }


}
