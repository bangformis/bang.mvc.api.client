<?php

require_once '../Config.php';
spl_autoload_register(function ($classname) {
    if ($classname == 'PHPUnit_Extensions_Story_TestCase' || $classname == 'Composer\Autoload\ClassLoader') {
        return;
    } else {
        $namespace_name = str_replace("\\", Config::DirSplitor, $classname);
        $namespace_path = Config::$Path . Config::DirSplitor . $namespace_name . '.php';
        if (file_exists($namespace_path)) {
            require_once($namespace_path);
        } else {
            throw new Exception("找不到 {$classname} 這個Class檔案，無法載入！");
        }
    }
});
