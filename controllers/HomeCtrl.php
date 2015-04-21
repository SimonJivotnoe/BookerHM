<?php

class HomeCtrl
{
    /**
     *
     */
    public function __construct()
    {
        $objView = DataContModel::getInstance();
        $objSess = new SessionModel();
        $sesCheck = $objSess->read('BookerLogin');
        if (!empty($sesCheck)) {
            $user_id = $_SESSION['BookerID'];
            $objAgent = new AgentPDOModel();
            $res = $objAgent->checkAdmin($user_id);
            $objView->setData($objAgent->getResArr());
            $objView->setRole($res);
            $objView->setStartPage(BOOKER);
        } else {
            //$this->startPage();
            $objView->setStartPage(INDEX);
        }
    }
}