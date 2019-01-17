<?php

class Config {

    /**
     * @var string 網站跟目錄（相對位置）
     */
    public static $Root = "/";
    public static $Path = __DIR__;

}

class ConfigApiName {

    const ApiUrl = 'http://localhost/bang.mvc/index.php';
    const EnableChecksum = true;
    const ChecksumKey = 'bang_api_test';
    const EnableLog = true;

}
