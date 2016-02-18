<?php

/**
 * 使用於工作或API一般回傳結果
 * @author Bang
 */
class TaskResult {
    
    public function __construct() {
        $this->IsSuccess = FALSE;
        $this->Message = "";
    }
    
    /**
     * @var bool 是否執行成功
     */
    public $IsSuccess;
    
    /**
     * @var string 結果訊息
     */
    public $Message;
    
    /**
     * @var mixed 結果值
     */
    public $Value;
    
    /**
     * @param string $msg
     * @return \TaskResult this
     */
    public function SetUnsuccess($msg = ''){
        $this->Message = $msg;
        $this->IsSuccess = FALSE;
        return $this;
    }
    
    /**
     * @param mixed $value
     * @param string $msg
     * @return \TaskResult this
     */
    public function SetSuccess($value = '' , $msg = ''){
        $this->IsSuccess = true;
        $this->Message = $msg;
        $this->Value = $value;
        return $this;
    }
    
}
