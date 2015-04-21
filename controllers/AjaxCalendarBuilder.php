<?php


class AjaxCalendarBuilder {
    public function __construct() {
        $objView = DataContModel::getInstance();
        $firstDay = $_GET['start'];
        $lastDay = $_GET['end'];
        $room_id = $_GET['room_id'];
        $user_id = $_SESSION['BookerID'];
        $objAgent = new AgentPDOModel();
        $res = $objAgent->getAppointments($firstDay, $lastDay, $room_id);
        array_push($res, array('user_id' => $user_id));
        $objView->setData($res);
    }
} 