<?php
/**
 * FileName : delete.php
 * User     : baihua
 * Date     : 2019/6/6 下午1:46
 * Time     : 下午1:46
 */

require __DIR__ . '/start.php';

use Elasticsearch\ClientBuilder;

$params = array(
    '127.0.0.1:8301',
    //'192.168.20.98:9200'
);


//$client = ClientBuilder::create()->build();
$client = ClientBuilder::create()->setHosts($params)->build();

/*
$params = [
    'index' => 'logstash-redis-2019.06.06',
    'type' => 'doc',
    'id' => 'd4VfKmsBTrUuVebRmBvP'
];
$result = $client->delete($params);
var_dump($result);
*/

$params = [
    'index' => 'logstash-redis-2019.06.06',
    'body'  => [
        'query' => [
            'match' => [
                '@message' => 'customerInfo'
            ]
        ]
    ]
];
$result = $client->deleteByQuery($params);
var_dump($result);