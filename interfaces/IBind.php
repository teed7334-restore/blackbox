<?php
/**
 * 變數綁定到物件-介面
 */
interface IBind {

    /**
     * 將參數綁定到RO物件
     * @param  object       $resultObject RO物件
     * @param  object|array $params       代入參數
     * @return void
     */
    public function bind($resultObject, $params);
}
