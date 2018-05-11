<?php
/**
 * 資料驗証主程式
 */
class Validation implements IValidation
{

    protected $errors;

    public function __construct()
    {
        $this->errors = [];
    }

    /**
     * 過濾輸入參數
     * @param  any    $value  參數
     * @param  string $type   資料格式
     * @param  string $assert 變數名
     * @return void
     */
    public function filter($value, $type, $assert)
    {
        $type = explode('=>', $type);

        /**
         * 判斷變數形態
         * @var array $type [0 => [變數形態], 1 => [字元長度]]
         */
        switch($type[0]) {
            case 'email':
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->errors[$assert] = false;
                }
                if (isset($type[1]) && (int) $type[1] < mb_strlen($value)) {
                    $this->errors[$assert] = false;
                }
                break;
            case 'url':
                if (!filter_var($value, FILTER_VALIDATE_URL)) {
                    $this->errors[$assert] = false;
                }
                if (isset($type[1]) && (int) $type[1] < mb_strlen($value)) {
                    $this->errors[$assert] = false;
                }
                break;
            case 'ip':
                if (!filter_var($value, FILTER_VALIDATE_IP)) {
                    $this->errors[$assert] = false;
                }
                if (isset($type[1]) && (int) $type[1] < mb_strlen($value)) {
                    $this->errors[$assert] = false;
                }
                break;
            case 'mac':
                if (!filter_var($value, FILTER_VALIDATE_MAC)) {
                    $this->errors[$assert] = false;
                }
                if (isset($type[1]) && (int) $type[1] < mb_strlen($value)) {
                    $this->errors[$assert] = false;
                }
                break;
            case 'datetime':
                if (!DateTime::createFromFormat($type[1], $value)) {
                    $this->errors[$assert] = false;
                }
                break;
            case 'number':
                if (!is_numeric($value)) {
                    $this->errors[$assert] = false;
                }
                if (isset($type[1]) && (int) $type[1] < mb_strlen($value)) {
                    $this->errors[$assert] = false;
                }
                break;
            case 'text':
                if ($value !== strip_tags($value)) {
                    $this->errors[$assert] = false;
                }
                if (isset($type[1]) && (int) $type[1] < mb_strlen($value)) {
                    $this->errors[$assert] = false;
                }
                break;
            case 'html':
                if (isset($type[1]) && (int) $type[1] < mb_strlen($value)) {
                    $this->errors[$assert] = false;
                }
                break;
            case 'enum':
                $type[1] = explode(',', $type[1]);
                if (!in_array($value, $type[1])) {
                    $this->errors[$assert] = false;
                }
                break;
            default:
                break;
        }
    }

    /**
     * 取得錯誤訊息
     * @return array 錯誤訊息 [[變數名稱] => false]
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
