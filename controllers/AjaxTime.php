<?php


class AjaxTime
{
    private $start;
    private $end;
    private $startDay;
    private $endDay;
    private $room_id;
    private $specifics;
    private $recurring;
    private $recType;
    private $duration;
    public function __construct()
    {
        $objView = DataContModel::getInstance();
        $objAgent = new AgentPDOModel();

        if (!empty($_POST['formMonth'])) {
            $this->start = $_POST[ 'start' ];
            $this->end = $_POST[ 'end' ];
            $this->startDay = $_POST[ 'startDay' ];
            $this->endDay = $_POST[ 'endDay' ];
            $this->room_id = $_POST[ 'room_id' ];
            $this->specifics = $_POST['bookerTextArea'];
            $this->recurring = $_POST[ 'recurring' ];
            if ('1' == $this->recurring) {
                $this->duration = (int)$_POST['duration'];
                $this->recType = (int)$_POST['recurringRes'];
            } else {
                $this->duration = 0;
            }
        } else {
            $this->start = $_GET[ 'start' ];
            $this->end = $_GET[ 'end' ];
            $this->startDay = $_GET[ 'startDay' ];
            $this->endDay = $_GET[ 'endDay' ];
            $this->room_id = $_GET[ 'room_id' ];
            $this->recType = (int)$_GET['recurringRes'];
            if ('' != $this->recType) {
                $this->duration = (int)$_GET['duration'];
            } else {
                $this->duration = 0;
            }
        }

        $res = $this->checkApp($this->start, $this->end, $this->duration, $this->recType, $this->room_id);
        if (!$res) {
            $objView->setData(array(0 => $res));
        } else {
            $app = $objAgent->getAppointments($this->startDay, $this->endDay, $this->room_id);
            if (0 == count($app)) {
                $this->insertApp();
            } else {
                $objValid = new ValidatorModel();
                $valid = $objValid->checkTime($app,$this->start, $this->end );
                if (0 == $valid) {
                    $this->insertApp();
                } else {
                    $objView->setData(array(0 => false));
                }
            }
        }
    }

    private function checkApp($startApp, $endApp, $duration, $recType, $room_id){
        $objAgent = new AgentPDOModel();
        $start = $startApp;
        $end = $endApp;
        $msInDay = 1000 * 60 * 60 * 24;
        $res = '';
        if (0 == $duration) {
            $res = $objAgent->checkAppointments($start, $end, $room_id);
        } else {
            for ($i = 0; $i <= $duration; $i++) {
                $res = $objAgent->checkAppointments($start, $end, $room_id);
                if (!$res) {break;}
                $start = ($recType * $msInDay) + $start;
                $end = ($recType * $msInDay) + $end;
            }
        }
        return $res;
    }

    private function insertApp(){
        $objView = DataContModel::getInstance();
        $objAgent = new AgentPDOModel();$objView->setData(array(0 => $_POST));
        if (!empty($_POST['formMonth'])) {
            $user_id = $_SESSION['BookerID'];
            $ins = $objAgent->insertAppointment($user_id, $this->start, $this->end,
                $this->specifics, $this->duration, $this->room_id);
            if ($ins) {
                $objView->setData(array(0 => true));
            } else {
                $objView->setData(array(0 => false));
            }
        } else {
            $objView->setData(array(0 => true));
        }
    }
} 