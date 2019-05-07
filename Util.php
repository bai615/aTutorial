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

//下划线命名到驼峰命名
function toCamelCase($str)
{
    $array  = explode('_', $str);
    $result = $array[0];
    $len    = count($array);
    if ($len > 1) {
        for ($i = 1; $i < $len; $i++) {
            $result .= ucfirst($array[$i]);
        }
    }
    return $result;
}

/**
 * 获取配置参数 为空则获取所有配置。
 * 多维配置获取时，以 . 分割，例如：parent.child
 * @param string $name
 * @return mixed|null
 */
function config($name = '')
{
    global $config_data;
    if (empty($name)) {
        return $config_data;
    } else {
        $name   = explode('.', $name);
        $config = $config_data;
        // 按.拆分成多维数组进行判断
        foreach ($name as $val) {
            if (empty($val)) {
                continue;
            } elseif (isset($config[$val])) {
                $config = $config[$val];
            } else {
                return null;
            }
        }
        return $config;
    }
}