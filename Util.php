<?php
/**
 * Created by PhpStorm.
 * User: SNDS
 * Date: 2019/4/24
 * Time: 16:57
 */

/**
 * 获取微秒时间戳
 * @return float
 */
function getMicroTime()
{
    list($msec, $sec) = explode(' ', microtime());
    return (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
}