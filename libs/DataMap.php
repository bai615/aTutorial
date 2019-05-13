<?php

class DataMap
{
    // 需要转换为整型的字段
    private static $int_maps = [
    ];

    // 需要转换为浮点型的字段
    private static $float_maps = [
    ];

    // 需要转换为日期的字段
    private static $datetime_maps = [
    ];

    /**
     * 过滤数组的key，进行变量类型强制转换
     * @param $data
     *
     * @return mixed
     */
    public static function filter(&$data)
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $data[$key] = self::filter($value);
            } elseif (in_array($key, self::$int_maps)) {
                $data[$key] = (int)$value;
            } elseif (in_array($key, self::$float_maps)) {
                $data[$key] = (float)$value;
            } elseif (in_array($key, self::$datetime_maps)) {
                if (empty($value)) $value = '0';
                $data[$key] = date('c', strtotime($value));
            }
        }
        return $data;
    }

    /**
     * 将 json 字符串中 int 类型数字转为 float 类型数字
     * 例如：将{"price":27}转为{"price":27.00}
     * @param $context
     */
    public static function formatter(&$context)
    {
        foreach (self::$float_maps as $data_key){
            $pattern = '/("'.$data_key.'":[0-9]+),/';
            $context = preg_replace($pattern, '${1}.00,', $context);
            $pattern = '/("'.$data_key.'":[0-9]+)}/';
            $context = preg_replace($pattern, '${1}.00}', $context);
        }
    }
}