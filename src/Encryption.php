<?php
/**
 * Created by PhpStorm.
 * User: 南丞
 * Date: 2019/2/15
 * Time: 12:48
 *
 *
 *                      _ooOoo_
 *                     o8888888o
 *                     88" . "88
 *                     (| ^_^ |)
 *                     O\  =  /O
 *                  ____/`---'\____
 *                .'  \\|     |//  `.
 *               /  \\|||  :  |||//  \
 *              /  _||||| -:- |||||-  \
 *              |   | \\\  -  /// |   |
 *              | \_|  ''\---/''  |   |
 *              \  .-\__  `-`  ___/-. /
 *            ___`. .'  /--.--\  `. . ___
 *          ."" '<  `.___\_<|>_/___.'  >'"".
 *        | | :  `- \`.;`\ _ /`;.`/ - ` : | |
 *        \  \ `-.   \_ __\ /__ _/   .-` /  /
 *  ========`-.____`-.___\_____/___.-`____.-'========
 *                       `=---='
 *  ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
 *           佛祖保佑       永无BUG     永不修改
 *
 */

namespace pf\encryption;

use pf\encryption\build\Base;

class Encryption
{
    protected static $link;

    protected function driver()
    {
        self::$link = new Base();
        return $this;
    }

    public function __call($name, $arguments)
    {
        if (!self::$link) {
            $this->driver();
        }
        return call_user_func_array([self::$link, $name], $arguments);
    }

    public static function single()
    {
        static $link = null;
        if (is_null($link)) {
            $link = new static();
        }
        return $link;
    }

    public static function __callStatic($name, $arguments)
    {
        return call_user_func_array([static::single(), $name], $arguments);
    }
}