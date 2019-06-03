<?php
/**
 * FileName : elasticsearch.php
 * Date     : 2019/6/3 下午9:00
 * Time     : 下午9:00
 */

// 载入composer的autoload文件
require __DIR__ . '/vendor/autoload.php';

use Elasticsearch\ClientBuilder;

$params = array(
    '127.0.0.1:9200',
);

//$client = ClientBuilder::create()->build();
$client = ClientBuilder::create()->setHosts($params)->build();

$params = [
    'index' => 'logstash-redis-2019.06.03',
];

// 判断索引是否存在
$result = $client->indices()->exists($params);
echo '---------- : ';
var_dump($result);
echo ' ---------- ';
echo '</br>';

// 删除索引
//$result = $client->indices()->delete($params);
var_dump($result);

$params = [
    'index' => 'logstash-2019.06.03',
    'body'  => [
        'settings' => [
            'number_of_shards'   => 5,
            'number_of_replicas' => 1
        ],
        "mappings" => [
            '_default_' => [],
            'doc' => [
            ],
        ]
    ]
];

// 在终端查看所有index命令:curl -X GET 'http://localhost:9200/_cat/indices?v'
$response = $client->indices()->create($params);
print_r($response);