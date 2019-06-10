<?php

// 载入composer的autoload文件
require __DIR__ . '/../vendor/autoload.php';


use Elasticsearch\ClientBuilder;

$params = array(
    '127.0.0.1:8301',
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

// 非会员
$params = [
    'index' => 'logstash-redis-2019.06.06',
    'body'  => [
        'query' => [
            "bool" => [
                "must_not" => [
                    [
                        'wildcard' => [
                            "@fields.ctxt_cardNo" => "*"
                        ]
                    ]
                ]

            ]
        ]
    ]
];

// 会员
$params = [
    'index' => 'logstash-redis-2019.06.06',
    'body'  => [
        'query' => [
            "bool" => [
                "must" => [
                    [
                        'wildcard' => [
                            "@fields.ctxt_cardNo" => "*"
                        ]
                    ]
                ]

            ]
        ]
    ]
];

$result = $client->search($params);
var_dump($result);