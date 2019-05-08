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
}