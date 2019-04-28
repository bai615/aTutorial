<?php
/**
 * Created by PhpStorm.
 * User: baihua
 * Date: 2019/4/24
 * Time: 下午7:41
 */

require './vendor/autoload.php';


//require_once './monolog/stream.php';


//require_once './monolog/stream_format.php';


//require_once './monolog/logstash_format.php';


//require_once './cache.php';

require_once './libs/AES.php';

$str = '{
"number":"123",
"string":"测试",
"double":1.0,
"boolean":true
}';
$key = $iv = '1234567812345678';

$aes = new AES();
$result = $aes->encrypt($str, $key, $iv);
var_dump($result);
$result = $aes->decrypt($result, $key, $iv);
var_dump($result);