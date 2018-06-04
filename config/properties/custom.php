<?php
/*
 * 自定义数据配置
 * This file is part of Swoft.
 * (c) Swoft <group@swoft.org>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    'redisKey' => [
        'live_game_detail_users'  => 'live_%d_detail_users'   //保存websocket直播详情的用户FD
    ],

    'systemParameter' => [
             'adminCookie' => 'adminLogin'                        //后台登录的cookie名
    ],

];

