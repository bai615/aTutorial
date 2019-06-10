<?php

// 载入composer的autoload文件
require __DIR__ . '/../vendor/autoload.php';

use Elasticsearch\ClientBuilder;

$params = array(
    '127.0.0.1:8301',
);


//$client = ClientBuilder::create()->build();
$client = ClientBuilder::create()->setHosts($params)->build();

//*
// 更新会员标识
$params = [
    'index' => 'logstash-2019.06.*',
    'body'  => [
        'query'  => [
            'wildcard' => [
                "@fields.ctxt_cardNo" => "*"
            ]
        ],
        'script' => [
            'inline' => "ctx._source['@fields'].ctxt_isCustomer=\"会员\""
        ]
    ]
];

//*/
/*
// 更新非会员标识
$params = [
    'index' => 'logstash-2019.06.*',
    'body'  => [
        'query'  => [
            'bool' =>[
                "must_not" => [
                    'wildcard' => [
                        "@fields.ctxt_cardNo" => "*"
                    ]
                ]
            ]
        ],
        'script' => [
            'inline' => "ctx._source['@fields'].ctxt_isCustomer=\"非会员\""
        ]
    ]
];
*/
$res = $client->updateByQuery($params);
var_dump($res);