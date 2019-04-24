<?php
/**
 * Created by PhpStorm.
 * User: baihua
 * Date: 2019/4/24
 * Time: 下午8:02
 */

use Symfony\Component\Cache\Adapter\FilesystemAdapter;

$cache = new FilesystemAdapter();

//var_dump($cache);

// create a new item by trying to get it from the cache
$productsCount = $cache->getItem('stats.products_count');

// assign a value to the item and save it
$productsCount->set(4711);
$cache->save($productsCount);

var_dump($productsCount->get());