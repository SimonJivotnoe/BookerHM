<?php

/**
 * Class ValidatorModel
 */
class ValidatorModel
{

    private $errorsMess = array();
    private $variablesArray = array();

    public function __construct()
    {
    }

    private function stripTagsAndTrim($checkValue)
    {
        $checkRes = strip_tags(trim($checkValue));

        return $checkRes;
    }

    private function checkValues($val, $name){
        if (strlen($val) <= 3 || strlen($val) >= 10){
            $this->errorsMess[ $name .'ERR' ] = $name .' length must be more 3 and less then 10 symbols';
            return false;
        } else {
            $this->variablesArray[ $name ] = $val;
            return true;
        }
    }

    public function formValidation($login, $pass)
    {
        $loginCheck = $this->stripTagsAndTrim($login);
        $checkLogin = $this->checkValues($loginCheck, 'login');
        $passCheck = $this->stripTagsAndTrim($pass);
        $checkPass = $this->checkValues($passCheck, 'pass');
        if ($checkLogin && $checkPass) {
            return true;
        } else {
            return false;
        }
    }

    public function checkTime($arr, $start, $end){
        $check = 0;
        foreach ($arr as $key => $val) {
            if ($end <= $val['start_time_ms'] || $start >= $val['end_time_ms']) {
            
            } else {
                $check .= 1;
            }
        }
        return $check;
    }

    public function getErrMess(){
        return $this->errorsMess;
    }

    /**
     * @return array
     */
    public function getVariablesArray()
    {
        return $this->variablesArray;
    }
} 