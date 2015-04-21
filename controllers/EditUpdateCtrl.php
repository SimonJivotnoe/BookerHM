<?php


class EditUpdateCtrl {
public function __construct() {
    $objView = DataContModel::getInstance();
    $objAgent = new AgentPDOModel();
    $objSess = new SessionModel();
    $sesCheck = $objSess->read('BookerLogin');
    $user_id = $_SESSION['BookerID'];
    if (empty($_POST['action'])) {
        $res = $objAgent->checkAdmin($user_id);
        $id = (int)$_GET['id'];
        $res = $objAgent->getAppointment($id );
        $objView->setStartPage('edit.html');
        $objView->setData($res);
    } else if('delete' == $_POST['action']){
        $recur = 0;
        if (isset($_POST['ifRec'])) {
            $recur = 1;
        }
        $app_id = $_POST['app_id'];
        $checkDel = $objAgent->checkDelete($user_id, $app_id );
        if ($checkDel) {
            $deleteApp = $objAgent->deleteAppointment($app_id, $recur);
            $objView->setData(array(0 => $deleteApp));
        }
    } else if('update' == $_POST['action']) {
        $recur = 0;
        if (isset($_POST['ifRec'])) {
            $recur = 1;
        }
        $app_id = $_POST['app_id'];
        $room_id = $_POST['room_id'];
        $startDay = $_POST['startDay'];
        $endDay = $_POST['endDay'];
        $startTime = ($_POST['startHour'] * 60 * 60) + ($_POST['startMin'] * 60) + ($startDay/1000);
        $endTime = ($_POST['endHour'] * 60 * 60) + ($_POST['endMin'] * 60) + ($startDay/1000);
        $startTime = (string)$startTime.'000';
        $endTime = (string)$endTime.'000';

        if (empty($recur)) {
            $appList = $objAgent->getAppointmentsInDay($app_id, $startDay, $endDay, $room_id);
            if (empty($appList)) {
                $objAgent->updateAppointment($app_id, $startTime, $endTime);
                $objView->setData(array(0 => $endTime));
            } else {
                $objView->setData(array(0 => $endTime));
            }

        } else {

        }
//$objView->setData(array(0 => $_POST));
    }
}
} 