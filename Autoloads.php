<?php

require_once 'Config.php';

/**
 * 自動載入lib中的Class功能
 */
function __autoload($classname) {
    $dir_spilit = "\\";
    $path_root = __DIR__;

    $namespace_name = str_replace("\\", $dir_spilit, $classname);
    $namespace_path = "{$path_root}{$dir_spilit}{$namespace_name}.php";
    if (file_exists($namespace_path)) {
        require_once($namespace_path);
    }

    $all_paths = array(
        'Lib/',
    );
    foreach ($all_paths as $path) {
        $full_path = $path_root . '/' . $path . $classname . '.php';
        if ($dir_spilit == "\\") {
            $full_path = str_replace('/', $dir_spilit, $full_path);
        }
        if (file_exists($full_path)) {
            require_once($full_path);
        }
    }
}

function EchoTestResult($test_results = array()) {
    foreach ($test_results as $key => $value) {
        $result = $value->IsSuccess ? 'OK' : 'NO';
        echo "{$result}.[{$key}]=>" . json_encode($value) . "\n";
    }
}
