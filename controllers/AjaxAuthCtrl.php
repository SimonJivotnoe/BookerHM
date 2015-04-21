<?php


class AjaxAuthCtrl {
    public function __construct() {
        $objView = DataContModel::getInstance();
            $login = $_POST[ 'loginAF' ];
            $pass = $_POST[ 'passAF' ];
            $objValidInputs = new ValidatorModel();
            $checkInputs = $objValidInputs->formValidation($login, $pass);
            if ($checkInputs) {
                $res = $objValidInputs->getVariablesArray();
                $objAgent = new AgentPDOModel();
                $query = $objAgent->checkUser($res);
                if (true === $query) {
                    $srtRes = $objAgent->getResArr();
                    $objSes = new SessionModel();
                    $objSes->add('BookerLogin', $srtRes[0]['user_name']);
                    $objSes->add('BookerID', $srtRes[0]['user_id']);
                 } else {
                    $objView->setData($query);
                }
            } else {
                $res = $objValidInputs->getErrMess();
                $objView->setData($res);
            }
    }
} 