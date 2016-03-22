<?php

namespace Bang\Lib;

/**
 * SQL 呼叫使用Bag,先Prepare後在執行
 * @author Bang
 */
class SqlBag {

    /**
     * 建立SqlBag
     * @param string $PrepareSql
     * @param array $KeyValues
     */
    function __construct($PrepareSql, $KeyValues) {
        $this->PrepareSql = $PrepareSql;
        $this->KeyValues = $KeyValues;
    }

    /**
     * @var string 準備好的Sql
     */
    public $PrepareSql;

    /**
     * @var array 即將注入的欄位與值
     */
    public $KeyValues;

}
