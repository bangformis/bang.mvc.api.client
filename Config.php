<?php

class Config {

    /**
     * @var string 網站跟目錄（相對位置）
     */
    public static $Root = "/";
    public static $Path = __DIR__;

    //系統使用的目錄分隔符號
    const DirSplitor = "\\";

}

class ApiConfig {

    const Url = 'http://localhost:8088/index.php';
    const Checksum = true;
    const Key = 'bang_api_test';

}
