<?php
/**
 * Created by PhpStorm.
 * User: bai615
 * Date: 2019/4/24
 * Time: 11:55
 */

use Elastica\Client;
use Monolog\Formatter\ElasticaFormatter;
use Monolog\Handler\ElasticSearchHandler;
use Monolog\Logger;

$formatter = new ElasticaFormatter('index_name', 'type_name');

$config = [
    'host' => '127.0.0.1',
    'port' => '',
];
$client = new Client($config);

$options  = [
    'index' => 'my_index',
    'type'  => 'doc_type',
];
$elastic = new ElasticSearchHandler($client, $options);
$elastic->setFormatter($formatter);

// bind it to a logger object
$securityLogger = new Logger('security');
$securityLogger->pushHandler($stream);

// add records to the log
$securityLogger->warning('Foo');
$securityLogger->error('Bar');
$securityLogger->info('添加新用户02', [' username ' => ' Seldaek ']);