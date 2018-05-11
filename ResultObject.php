<?php
/**
 * RO物件
 */
class ResultObject implements IResultObject
{
    public $status;
    public $params;
    public $errors;
    public $data;

    public function __construct()
    {
        $this->status = true;
        $this->params = [];
        $this->errors = [];
        $this->data = [];
    }

    /**
     * 設定狀態
     * @param bool $status 成功:true|失敗:false
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * 設定代入參數
     * @param any $params 代入參數
     */
    public function setParams($params)
    {
        $this->params = $params;
    }

    /**
     * 設定錯誤訊息
     * @param array $errors 錯誤訊息 [[變數名稱] => false]
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
    }

    /**
     * 設定查詢結果
     * @param any $data 查詢結果
     */
    public function setData($data)
    {
        $this->data = $data;
    }
}
