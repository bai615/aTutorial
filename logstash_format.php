<?php
/**
 * Created by PhpStorm.
 * User: baihua
 * Date: 2019/4/24
 * Time: 下午7:51
 */

use Monolog\Formatter\LogstashFormatter;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$formatter = new LogstashFormatter('type_name');

$stream = new StreamHandler(__DIR__.'/logstash.log', Logger::INFO);
$stream->setFormatter($formatter);

$securityLogger = new Logger('security');
$securityLogger->pushHandler($stream);

$securityLogger->warning('Foo');
$securityLogger->error('Bar');
$securityLogger->info('添加新用户', ['username' => 'Seldaek']);