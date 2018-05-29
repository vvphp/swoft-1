<?php
/**
 * This file is part of Swoft.
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Middlewares;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Swoft\Bean\Annotation\Bean;
use Swoft\Http\Message\Middleware\MiddlewareInterface;

/**
 * the sub middleware of controler
 * @Bean()
 *
 * @uses      ControllerMiddleware
 * @version   2017年11月29日
 * @author    stelin <phpcrazy@126.com>
 * @copyright Copyright 2010-2016 swoft software
 * @license   PHP Version 7.x {@link http://www.php.net/license/3_0.txt}
 */
class ControllerMiddleware implements MiddlewareInterface
{

    /**
     * 允许不登录 直接访问的地址
     * @var array
     */
    private $allowAccess = [
        '/admin/index/index'
    ];

    /**
     * 后台登录的cookie名
     * @var string
     */
    static $adminCookie = 'adminLogin';

    /**
     * 跳转登录地址URL
     * @var string
     */
    static $loginUrl = '/admin/index/login';

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Server\RequestHandlerInterface $handler
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \InvalidArgumentException
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
       $auth = $this->checkLogin($request);
       if($auth == false){
            return \response()->redirect(self::$loginUrl);
       }
        return  $handler->handle($request);
     }

    /**
     * 检查是否登录
     * @param ServerRequestInterface $request
     * @return  boolean
     */
    private function checkLogin(ServerRequestInterface $request)
    {
        $path = $request->getUri()->getPath();
        if(in_array($path,$this->allowAccess)){
             return true;
        }
        $cookie = $request->getCookieParams();
        $cookieName = self::$adminCookie;
        if(!isset($cookie[$cookieName]) || empty($cookie[$cookieName])){
             return false;
        }
    }

}