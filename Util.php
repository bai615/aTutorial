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
 *
 * @param string $name
 *
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

/**
 * 将时间戳字符串转为日期时间格式
 *
 * @param $time_str
 * @param $format
 *
 * @return string
 */
function strtotimeformat($time_str, $format = 'YmdHis')
{
    // 除去微秒部分
    $time_str = substr($time_str, 0, 10);
    $strlen   = strlen($time_str);
    $time     = 0;
    for ($i = 0; $i < $strlen; $i++) {
        $time = $time * 10 + ((int)substr($time_str, $i, 1));
    }
    return date($format, $time);
}

/**
 * 获取某年的每周第一天和最后一天
 *
 * @param  [int] $year [年份]
 *
 * @return mixed [array]       [每周的周一和周日]
 */
function getWeek($year)
{
    $year_start  = $year . "-01-01";
    $year_end    = $year . "-12-31";
    $start_day   = strtotime('Monday this week', strtotime($year_start));
    $year_monday = date("Y-m-d", $start_day); //获取年第一周的日期

    for ($i = 1; $i <= 52; $i++) {
        $j          = $i - 1;
        $start_date = date("Y-m-d", strtotime("$year_monday $j week "));

        $end_day = date("Y-m-d", strtotime("$start_date +6 day"));

        $week_array[$i] = array(
            str_replace("-",
                ".",
                $start_date
            ), str_replace("-", ".", $end_day));
    }
    return $week_array;
}

/**
 * 获取指定月的第一天和最后一天
 * @param $date
 *
 * @return array
 */
function getFirstAndLastDayOfMonth($date)
{
    $first_day = date('Y-m-01', strtotime($date));
    $last_day  = date('Y-m-d', strtotime("$first_day +1 month -1 day"));
    return [$first_day, $last_day];
}
