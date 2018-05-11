<?php
include_once ('Autoload.php');

/**
 * 黑盒子主程式
 */
class BlackBox implements IBlackBox {

    protected $ro;

    public function __construct()
    {
        /**
         * 啟用RO物件
         * @var ResultObject
         */
        $this->ro = new ResultObject();
    }

    /**
     * 主程式
     * @param  array       $params     代入參數
     * @param  IValidation $validate   參數驗証主程式
     * @param  IRepository $repository 查詢主程式
     * @return IResultObject {'status' => [是否成功:true|false], 'params' => [代入參數], 'error' => [未通過驗証的參數], 'data' => [查詢回傳結果]}
     */
    public function run($params, $validate, $repository)
    {
        $this->ro->setParams($params);

        $status = $this->doValidate($validate);
        if (!$status) {
            return $this->ro;
        }

        $table = $params['__table'];
        $repository->setTable($table);
        $result = $this->doRepository($repository);

        $this->ro->setData($result);
        if (!$result) {
            $this->ro->setStatus(false);
        } else {
            $this->ro->setStatus(true);
        }

        return $this->ro;
    }

    /**
     * 運行查詢主程式
     * @param  IRepository $repository 查詢主程式
     * @return any         查詢結果
     */
    private function doRepository($repository)
    {
        $params = $this->ro->params;

        $method = $params['__method'];

        unset($params['__method']);
        unset($params['__table']);
        unset($params['__filterRules']);

        $result = $repository->{$method}($params);
        return $result;
    }

    /**
     * 運行驗証主程式
     * @param  IValidation $validate 驗証主程式
     * @return bool        是否通過驗証:true|false
     */
    private function doValidate($validate)
    {
        $params = $this->ro->params;

        if (empty($params)) {
            $this->ro->setStatus(false);
            return false;
        }

        if (!isset($params['__table']))
        {
            $this->ro->setStatus(false);
            return false;
        }

        $table = $params['__table'];

        if (!isset($params['__method']))
        {
            $this->ro->setStatus(false);
            return false;
        }

        $method = $params['__method'];

        $filterRules = isset($params['__filterRules']) ? $params['__filterRules'] : [];

        foreach($filterRules as $key => $value) {
            if (isset($params[$key])) {
                $validate->filter($params[$key], $filterRules[$key], $key);
            } else {
                $validate->filter(null, $filterRules[$key], $key);
            }
        }

        $errors = $validate->getErrors();
        if (!empty($errors)) {
            $this->ro->setErrors($errors);
            $this->ro->setStatus(false);
            return false;
        }

        return true;
    }
}
