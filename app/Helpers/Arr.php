<?php
namespace Alex\CodingTaskDataFeed\Helpers;
class Arr
{
    static function get($arr,$key): mixed
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

    static function has($arr, $key): bool
    {
        $keys = explode('.', $key);
        $has = false;
        foreach ($keys as $key) {
            if (key_exists($key, $arr)) {
                $arr = $arr[$key];
            } else {
                return $has;
            }
        }
        $has=true;
        return $has;
    }
}