<?php

class Config {

    /**
     * @var string 網站跟目錄（相對位置）
     */
    public static $Root = "/";
    public static $Path = __DIR__;

}

class ApiConfig {

    const Url = 'http://localhost/bang.mvc/index.php';
    const Checksum = true;
    const Key = 'bang_api_test';

}
