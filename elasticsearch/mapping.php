<?php
/**
 * 给已存在的 mapping 增加新字段
 * FileName : mapping.php
 * User     : baihua
 * Date     : 2019/6/11 下午8:16
 * Time     : 下午8:16
 */

require __DIR__ . '/start.php';

use Elasticsearch\ClientBuilder;

$params = array(
    '127.0.0.1:8301',
);


//$client = ClientBuilder::create()->build();
$client = ClientBuilder::create()->setHosts($params)->build();


$params = [
    'index' => 'logstash-2019.06.11',
    'type'  => 'doc',
    'body'  => [
        "properties" => [
            "@fields" => [
                "properties" => [
                    "ctxt_isCustomer456" => [
                        "type"   => "text",
                        "fields" => [
                            "keyword" => [
                                "ignore_above" => 256,
                                "type"         => "keyword"
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ]
];

$response = $client->indices()->putMapping($params);
print_r($response);