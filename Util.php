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

//驼峰命名转下划线命名
function toUnderScore($str)
{
    $dstr = preg_replace_callback('/([A-Z]+)/', function ($matchs) {
        return '_' . strtolower($matchs[0]);
    }, $str);
    return trim(preg_replace('/_{2,}/', '_', $dstr), '_');
}
