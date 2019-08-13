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

/**
 * 生成UUID
 * @return string
 */
function genUUID()
{
    $uuid = array(
        'time_low'      => 0,
        'time_mid'      => 0,
        'time_hi'       => 0,
        'clock_seq_hi'  => 0,
        'clock_seq_low' => 0,
        'node'          => array()
    );

    $uuid['time_low']      = mt_rand(0, 0xffff) + (mt_rand(0, 0xffff) << 16);
    $uuid['time_mid']      = mt_rand(0, 0xffff);
    $uuid['time_hi']       = (4 << 12) | (mt_rand(0, 0x1000));
    $uuid['clock_seq_hi']  = (1 << 7) | (mt_rand(0, 128));
    $uuid['clock_seq_low'] = mt_rand(0, 255);

    for ($i = 0; $i < 6; $i++) {
        $uuid['node'][$i] = mt_rand(0, 255);
    }

    $uuid = sprintf('%08x-%04x-%04x-%02x%02x-%02x%02x%02x%02x%02x%02x',
        $uuid['time_low'],
        $uuid['time_mid'],
        $uuid['time_hi'],
        $uuid['clock_seq_hi'],
        $uuid['clock_seq_low'],
        $uuid['node'][0],
        $uuid['node'][1],
        $uuid['node'][2],
        $uuid['node'][3],
        $uuid['node'][4],
        $uuid['node'][5]
    );

    return $uuid;
}

/**
 * 对数组变量进行 JSON 编码
 * PHP5.4才支持JSON_UNESCAPED_UNICODE这个参数，此参数是让中文字符在json_encode的时候不用转义，减少数据传输量。
 * @param mixed array 待编码的 array (除了resource 类型之外，可以为任何数据类型，该函数只能接受 UTF-8 编码的数据)
 * @return string (返回 array 值的 JSON 形式)
 */
function json_encode($array)
{
    if(version_compare(PHP_VERSION,'5.4.0','<')){
        $str = json_encode($array);
        $str = preg_replace_callback("#\\\u([0-9a-f]{4})#i",function($matchs){
            return iconv('UCS-2BE', 'UTF-8', pack('H4', $matchs[1]));
        },$str);
        return $str;
    }else{
        return json_encode($array, JSON_UNESCAPED_UNICODE);
    }
}
