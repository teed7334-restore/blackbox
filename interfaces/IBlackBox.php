<?php
/**
 * 黑盒子主程式-介面
 */
interface IBlackBox {

    /**
     * 主程式
     * @param  array       $params     代入參數
     * @param  IValidation $validate   參數驗証主程式
     * @param  IRepository $repository 查詢主程式
     * @return IResultObject {'status' => [是否成功:true|false], 'params' => [代入參數], 'error' => [未通過驗証的參數], 'data' => [查詢回傳結果]}
     */
    public function run($params, $validate, $repository);
}
