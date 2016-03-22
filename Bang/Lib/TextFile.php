<?php

namespace Bang\Lib;

/**
 * @author Bang
 */
class TextFile {

    public function __construct($path) {
        $this->Path = $path;
    }

    private $Path;

    public function Read() {
        $path = Path::Content($this->Path);
        if (is_file($path)) {
            $file = fopen($path, "r");
            $content = fread($file, filesize($path));
            fclose($file);
            return $content;
        } else {
            throw new \Exception('File not found!', 404);
        }
    }

    public function Write($content) {
        $path = Path::Content($this->Path);
        $file = fopen($path, "w");
        fwrite($file, $content);
        fclose($file);
    }

}
