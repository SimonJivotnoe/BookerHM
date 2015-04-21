<?php


class DeleteUser {
public function __construct() {
    $objView = DataContModel::getInstance();
    $userId = $_GET['userId'];
    $objAgent = new AgentPDOModel();
    if (!empty($userId)) {
        $res = $objAgent->deleteUser($userId);
        $objView->setData(array(0 => $res));
    } else {

    }
}
} 