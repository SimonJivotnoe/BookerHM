<?php


class Employee_list_ctrl {
public function __construct() {
    $objView = DataContModel::getInstance();
    $user_id = $_SESSION['BookerID'];
    $objAgent = new AgentPDOModel();
    $res = $objAgent->checkAdmin($user_id);
    if ($res) {
        $objView->setData($objAgent->getResArr());
        $objView->setStartPage(EMPLOYEES);
    } else {
        new HomeCtrl();
    }
}
} 