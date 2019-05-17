<?php

include './libs/Redis.php';

use Services\Redis;

$redis = Redis::getInstance();
$redis->sadd('customerMobile1', '13811831963');
$redis->sadd('customerMobile1', '13601377165');
$result = $redis->sadd('customerMobile1', '13811831963');
var_dump($result);
$result = $redis->sadd('customerMobile1', '13611187941');
var_dump($result);
var_dump($redis->smembers('customerMobile1'));
