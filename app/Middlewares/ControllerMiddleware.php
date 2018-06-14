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
use App\Common\Helper\Login;


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
     * 允许直接访问的地址
     * @var array
     */
    private $allowAccess = [
        '/admin/index/login',
        '/admin/index/signin'
    ];

    /**
     * 跳转登录地址URL
     * @var string
     */
   public static $loginUrl = '/admin/index/login';

    /**
     * 跳转到后台首页
     * @var string
     */
   public static $adminIndex = "/admin/index/index";

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Server\RequestHandlerInterface $handler
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \InvalidArgumentException
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
       $checkPath = $this->checkCurrentPath($request);
       $auth = $this->auth($request);
       if($checkPath == false && $auth == false){
            return \response()->redirect(self::$loginUrl);
       }
       $redirect = $this->checkRedirectIndexUrl($request);
       if($redirect){
           return \response()->redirect(self::$adminIndex);
        }
        return  $handler->handle($request);
     }

    /**
     * 检查当前路径
     * @param ServerRequestInterface $request
     * @return bool
     */
    private function checkCurrentPath(ServerRequestInterface $request)
    {
        $path = $request->getUri()->getPath();
        if(in_array($path,$this->allowAccess)){
            return true;
        }
        return false;
    }

    /**
     * 如果登录后，再访问登录页面 就直接跳转到后台首页
     * @param ServerRequestInterface $request
     */
    public function checkRedirectIndexUrl(ServerRequestInterface $request)
    {
        $path = $request->getUri()->getPath();
        $auth = $this->auth($request);
        if(strcasecmp($path,self::$loginUrl) === 0 && !empty($auth)){
             return true;
        }
        return false;
    }


    /**
     * 检查是否登录
     * @param ServerRequestInterface $request
     * @return bool
     */
    public function auth(ServerRequestInterface $request)
    {
        return  Login::isAuth($request);
    }


}