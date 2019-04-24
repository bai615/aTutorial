<?php
/**
 * Created by PhpStorm.
 * User: baihua
 * Date: 2019/4/24
 * Time: 下午5:06
 */

use Monolog\Formatter\JsonFormatter;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$formatter = new JsonFormatter();

$stream = new StreamHandler(__DIR__.'/json.log', Logger::INFO);
$stream->setFormatter($formatter);

$securityLogger = new Logger('security');
$securityLogger->pushHandler($stream);

$securityLogger->warning('Foo');
$securityLogger->error('Bar');
$securityLogger->info('添加新用户', ['username' => 'Seldaek']);