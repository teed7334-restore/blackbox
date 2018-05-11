<?php
/**
 * 參考設計用查詢主程式-介面
 */
interface IRepository {

    /**
     * 設定使用的資料表
     * @param string $table 資料表名稱
     */
    public function setTable($table);

    /**
     * 取得多筆資料
     * @param  array $params  代入參數
     * @return object 查詢結果
     */
    public function getList($params);

    /**
     * 取得單筆資料
     * @param  array $params  代入參數
     * @return object 查詢結果
     */
    public function getRow($params);

    /**
     * 新增一筆資料
     * @param  array $params  代入參數
     * @return string 新增資料的主鍵
     */
    public function add($params);

    /**
     * 修改資料
     * @param  array $params  代入參數
     * @return int 影響的資料筆數
     */
    public function edit($params);

    /**
     * 刪除資料
     * @param  array $params  代入參數
     * @return int 影響的資料筆數
     */
    public function remove($params);
}
