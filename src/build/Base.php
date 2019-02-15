<?php
/**
 * Created by PhpStorm.
 * User: 南丞
 * Date: 2019/2/15
 * Time: 16:37
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

namespace pf\encryption\build;

use pf\config\Config;

class Base
{
    protected $config;
    protected $secureKey = 'FB1C3D9E746345FF262F534C83469335';

    public function key($key = '')
    {
        $this->secureKey = $key ?: Config::get('app.key', $this->secureKey);
        return base64_decode(hash('sha256', $this->secureKey, true));
    }

    public function encrypt($input, $secureKey = '')
    {
        $encrypt = openssl_encrypt($input, 'aes-256-cbc',
            $this->key($secureKey),
            OPENSSL_RAW_DATA,
            substr($this->secureKey, -16));
        return base64_encode($encrypt);
    }

    public function decrypt($input, $secureKey = '')
    {
        $encrypted = base64_decode($input);
        $decrypted = openssl_decrypt(
            $encrypted,
            'aes-256-cbc',
            $this->key($secureKey),
            OPENSSL_RAW_DATA,
            substr($this->secureKey, -16)
        );
        return $decrypted;
    }

    public function salt_encrypt($input)
    {
        $salt = md5(str_shuffle(uniqid()));
        $encrypted = md5(md5($salt . $input));
        return [$salt, $encrypted];
    }
}