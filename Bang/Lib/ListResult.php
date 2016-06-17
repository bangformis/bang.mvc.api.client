<?php

namespace Bang\Lib;

/**
 * @author Bang
 */
class ListResult {

    function __construct($Datas, $TotalItems, $TotalPages) {
        $this->Datas = $Datas;
        $this->TotalItems = $TotalItems;
        $this->TotalPages = $TotalPages;
    }

    public $Datas;
    public $TotalItems;
    public $TotalPages;

}
