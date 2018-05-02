<?php
/**
 * 直播项目，基础类.
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Controllers\Live;

use Swoft\App;
/**
 * Class BaseController
 */
class BaseController
{
    protected static $language = '';

    public function __construct()
    {
        self::$language = App::$properties['language'];
    }


}

