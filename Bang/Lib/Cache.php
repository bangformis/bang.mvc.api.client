<?php
namespace Bang\Lib;
/**
 * 資料快取模型
 * @author Bang
 */
class Cache {

    function __construct($name, $data, $time_up_seconds = 120) {
        $this->name = $name;
        $this->data = $data;
        $this->last_update = time();
        $this->time_up_seconds = $time_up_seconds;
    }

    /**
     * @var string 快取名稱(識別)
     */
    public $name;

    /**
     *
     * @var mixed 資料
     */
    public $data;

    /**
     * @var timestamp 最後更新時間
     */
    public $last_update;

    /**
     * @var integer 過期秒數
     */
    public $time_up_seconds;

    public function Update($data, $last_update = FALSE, $time_up_seconds = FALSE) {
        if ($last_update == FALSE) {
            $last_update = time();
        }
        if ($time_up_seconds == FALSE) {
            $time_up_seconds = $this->time_up_seconds;
        }
        
        $this->data = $data;
        $this->last_update = $last_update;
        $this->time_up_seconds = $time_up_seconds;
    }

    /**
     * 
     * @return boolean 是否需要更新快取
     */
    public function IsTimeout() {
        if (isset($_GET['UpdateAllCache'])) {
            return true;
        }
        $timeout_seconds = $this->time_up_seconds;
        $now = time();
        $last_update = $this->last_update;
        return ($now - $last_update) >= $timeout_seconds;
    }

    /**
     * 設定快取資料
     * @param string $name 快取名稱
     * @param mixed $data 快取資料
     * @param int $timeout_seconds 過期秒數
     * @return Cache 快取物件檔案
     */
    public static function Set($name, $data, $timeout_seconds = 120) {
        $key = Cache::StroeName($name);
        $cache = new Cache($key, $data, $timeout_seconds);
        Appstore::Set($key, $cache);
        return $cache;
    }

    /**
     * 取得快取物件
     * @param string $name 快取名稱
     * @return Cache 快取物件
     */
    public static function Get($name) {
        $key = Cache::StroeName($name);
        $cache = Appstore::Get($key);
        return $cache;
    }

    private static function StroeName($name) {
        return Cache::$KeyPrefix . $name;
    }

    private static $KeyPrefix = "__Cache";

    /**
     * @param type $obj
     * @return Cache
     */
    public static function AsTo($obj) {
        return $obj;
    }

}
