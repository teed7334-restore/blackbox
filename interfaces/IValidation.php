<?php
/**
 * 資料驗証主程式-介面
 */
interface IValidation {

    /**
     * 過濾輸入參數
     * @param  any    $value  參數
     * @param  string $type   資料格式
     * @param  string $assert 變數名
     * @return void
     */
    public function filter($value, $type, $assert);

    /**
     * 取得錯誤訊息
     * @return array 錯誤訊息 [[變數名稱] => false]
     */
    public function getErrors();
}
