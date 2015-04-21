<?php


class EmployeesPaletteModel {
    private $repArr = array();

    /**
     *
     */
    public function __construct()
    {

    }

    public function getArr()
    {
        $obj = DataContModel::getInstance();
        $arr = $obj->getData();
        //var_dump($arr);
        $sub = new SubstitutionModel();
        $i = 1;
        $userList = '';
        foreach ($arr as $key => $val) {
            $userArr = array('%USER_NAME%' => $val['user_name'],
                             '%USER_PASS%' => $val['user_pass'],
                             '%USER_EMAIL%' => $val['user_mail'],
                             '%USER_ID%' => $val['user_id'],
                             '%I%' => $i,);
            $userList .= $sub->subHTMLReplace('empAcc.html', $userArr);
            $i++;
        }
        $this->repArr['%EMPLOYEELIST%'] = $userList;

        return $this->repArr;
    }
} 