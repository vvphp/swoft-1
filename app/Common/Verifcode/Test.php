<?php
namespace App\Common\Verifcode;

use Swoft\App;
use Swoft\Core\Coroutine;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Log\Log;
use Swoft\View\Bean\Annotation\View;
use Swoft\Contract\Arrayable;
use Swoft\Http\Server\Exception\BadRequestException;
use Swoft\Http\Message\Server\Response;
use Swoft\Cache\Cache;
use Swoft\Bean\Annotation\Inject;
use App\Common\Sms\AliCode;
use App\Common\Tool\Valitron;
use Swoft\Http\Message\Server\Request;
use App\Common\Tool\Util;
use App\Common\Verifcode\Code;


class Test
{
    /**
     * @Inject()
     * @var \Swoft\Redis\Redis
     */
    private $redis;

    public function rd()
    {
        return $this->redis;
    }

}
