<?php


/**
 * Created by PhpStorm.
 * User: 南丞
 * Date: 2019/2/15
 * Time: 17:08
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

use pf\config\Config;
use pf\encryption\Encryption;

class EncryptionTest extends \PHPUnit\Framework\TestCase
{
    public function setUp()
    {
        parent::setUp();
        Config::loadFiles('config');
    }

    public function testKey()
    {
        $this->assertInternalType('string', Encryption::key());
    }

    public function testBase()
    {
        $d = Encryption::encrypt('pfinal社区');
        $this->assertEquals(Encryption::decrypt($d), 'pfinal社区');
        $this->assertInternalType('array', Encryption::salt_encrypt('admin'));
    }
}