<?php
/**
 * 變數綁定到物件用
 */
class Bind implements IBind
{
    public $resultObject;
    public $params;

    public function __construct()
    {
        $this->resultObject = new stdClass();
        $this->params = [];
    }

    /**
     * 將參數綁定到RO物件
     * @param  object       $resultObject RO物件
     * @param  object|array $params       代入參數
     * @return void
     */
    public function bind($resultObject, $params)
    {
        $this->resultObject = $resultObject;
        $this->params = (array) $params;

        foreach ($this->resultObject as $key => $value) {
            if (isset($this->params[$key])) {
                $this->resultObject->{$key} = $this->params[$key];
            }
        }
    }
}
