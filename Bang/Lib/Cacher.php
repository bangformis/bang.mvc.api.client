<?php
namespace Bang\Lib;
/**
 * @author Bang
 */
class Cacher {

    public static function Cache($name, $timeout_func, $timeout_second) {
        $cache = Cache::Get($name);
        $data = null;
        if ((!$cache) || $cache->IsTimeout()) {
            $data = $timeout_func();
            Cache::Set($name, $data, $timeout_second);
        } else {
            $data = $cache->data;
        }
        return $data;
    }

}
