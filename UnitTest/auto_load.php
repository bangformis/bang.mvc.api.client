<?php

require_once '../Config.php';

/**
 * 自動載入lib中的Class功能
 */
function __mvc_system_autoload($classname) {
    $namespace_name = str_replace("\\", DIRECTORY_SEPARATOR, $classname);
    $namespace_path = __DIR__ . DIRECTORY_SEPARATOR . $namespace_name . '.php';
    if (file_exists($namespace_path)) {
        require_once($namespace_path);
    } else {
        throw new Exception("The class {$classname} was not found!");
    }
}

spl_autoload_register('__mvc_system_autoload');
