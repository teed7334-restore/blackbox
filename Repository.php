<?php
/**
 * 參考設計用查詢主程式
 */
class Repository implements IRepository
{
    protected $table;
    protected $orm;
    protected $bind;

    public function __construct()
    {
        $this->bind = new Bind();
    }

    /**
     * 設定使用的資料表
     * @param string $table 資料表名稱
     */
    public function setTable($table)
    {
        $this->table = $table;
        $this->orm = new ADOdb_Active_Record($this->table);
    }

    /**
     * 取得多筆資料
     * @param  array $params  代入參數
     * @return object 查詢結果
     */
    public function getList($params)
    {

    }

    /**
     * 取得單筆資料
     * @param  array $params  代入參數
     * @return object 查詢結果
     */
    public function getRow($params)
    {
        $this->scopePK('id', $params['id']);
        return $this->orm;
    }

    /**
     * 新增一筆資料
     * @param  array $params  代入參數
     * @return string 新增資料的主鍵
     */
    public function add($params)
    {
        unset($params['id']);
        $this->bind->bind($this->orm, $params);
        $this->orm->save();
        $id = $this->orm->id;
        return $id;
    }

    /**
     * 修改資料
     * @param  array $params  代入參數
     * @return int 影響的資料筆數
     */
    public function edit($params)
    {
        $id = isset($params['id']) ? $params['id'] : null;
        unset($params['id']);
        $this->scopePK('id', $id);
        $this->bind->bind($this->orm, $params);
        $this->orm->save();
        $num = $this->orm->_saved;

        return $num;
    }

    /**
     * 刪除資料
     * @param  array $params  代入參數
     * @return int 影響的資料筆數
     */
    public function remove($params)
    {

    }

    /**
     * 取得資料表所有欄位
     * @return array [[欄位名]]
     */
    public function getColumns()
    {
        $columns = $this->orm->getAttributeNames();
        return $columns;
    }

    /**
     * 取得設定的驗証規則
     * @param  array $customRules 自訂的驗証規則 [[欄位名]:[驗証規則], [欄位名]:[驗証規則], ...]
     * @param  array $deny        無需驗証的欄位 [[欄位名], [欄位名], ...]
     * @return array 驗証規則 [[欄位名]:[驗証規則], [欄位名]:[驗証規則], ...]
     */
    public function getFilterRules($customRules, $deny)
    {
        $columns = $this->getColumns();
        $filters = [];
        foreach($columns as $col) {
            if (!in_array($col, $deny)) {
                $filters[$col] = isset($customRules[$col]) ? $customRules[$col] : 'any';
            }
        }
        return $filters;
    }

    /**
     * 給未代入值的參數加入初始值
     * @param  array $params 代入參數集:[[欄位名稱]:[欄位值]]
     * @param  array $defaultValues 預設值:[[欄位名稱]:[預設值]]
     * @return array 參數集:[[欄位名稱]:[預設值]]
     */
    public function setDefaultValues($params, $defaultValues)
    {
        foreach($defaultValues as $key => $value) {
            if (!isset($params[$key])) {
                $params[$key] = $value;
            } else if (empty($params[$key])) {
                $params[$key] = $value;
            }
        }

        return $params;
    }

    /**
     * 取得一個空的資料模型
     * @return array $params 參數集
     */
    public function getDataModel()
    {
        $params = [];
        $columns = $this->getColumns();

        foreach($columns as $value) {
            if (!isset($params[$value])) {
                $params[$value] = '';
            }
        }

        return $params;
    }

    /**
     * 依主鍵選取資料
     * @param  string $primaryKey 主鍵名稱
     * @param  string $value      主鍵數值
     * @return IRepository        主查詢程式
     */
    protected function scopePK($primaryKey, $value)
    {
        $this->orm->load("{$primaryKey} = ?", $value);
        return $this;
    }
}
