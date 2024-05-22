<?php
namespace Alex\CodingTaskDataFeed\Helpers;
class Arr
{
    static function get($arr,$key)
    {
        $keys = explode('.', $key);
        foreach ($keys as $key) {
            if (isset($arr[$key])) {
                $arr = $arr[$key];
            } else {
                return null;
            }
        }
        return $arr;
    }
}