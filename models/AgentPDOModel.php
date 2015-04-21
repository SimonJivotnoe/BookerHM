<?php


class AgentPDOModel {
    private $resArr = array();
    private $resID;
    public function __construct() {

    }

    public function checkUser($checkArr){
        $name = $checkArr['login'];
        $pass = $checkArr['pass'];
        $pdo = PDOModel::connect();
        $res = $pdo ->select("user_name, user_pass, user_id")
                    ->from("EMPLOYEES")
                    ->where("user_name = '$name' AND user_pass = '$pass'")
                    ->exec();
        if (0 == count($res)) {
            return array('noUser' => 'ask admin to register You');
        } else {
            $this->resArr = $res;
            return true;
        }
    }

    public function checkAdmin($user_id){
        $pdo = PDOModel::connect();
        $res = $pdo ->select("user_name, user_pass, user_id")
            ->from("EMPLOYEES")
            ->where("user_id = '$user_id' AND role = 'admin'")
            ->exec();
        if (0 == count($res)) {
            $list = $pdo ->select("user_id, user_name, user_pass, user_mail")
                ->from("EMPLOYEES")
                ->where("user_id = '$user_id'")
                ->exec();
            $this->resArr = $list;
            return false;
        } else {
            $list = $pdo ->select("user_id, user_name, user_pass, user_mail")
                ->from("EMPLOYEES")
                ->where("role = ''")
                  ->exec();
            $this->resArr = $list;
            return true;
        }
    }
    public function getAppointments($firstDay, $lastDay, $room_id){
        $pdo = PDOModel::connect();
        $res = $pdo->select("id, user_id, start_time_ms, end_time_ms")
                    ->from("APPOINTMENTS")
                    ->where("start_time_ms >='$firstDay' AND end_time_ms <='$lastDay' AND
                    room_id = '$room_id' ORDER BY start_time_ms ASC")
                    ->exec();
        return $res;
    }
    public function getAppointmentsInDay($app_id, $firstDay, $lastDay, $room_id){
        $pdo = PDOModel::connect();
        $res = $pdo->select("id, user_id, start_time_ms, end_time_ms")
            ->from("APPOINTMENTS")
            ->where("start_time_ms >='$firstDay' AND end_time_ms <='$lastDay' AND
                    room_id = '$room_id' AND id != '$app_id' ORDER BY start_time_ms ASC")
            ->exec();
        return $res;
    }
    public function getAppointment($id){
        $pdo = PDOModel::connect();
        $res = $pdo->select("id, user_id, start_time_ms, end_time_ms, recurrent, submitted, description")
            ->from("APPOINTMENTS")
            ->where("id = '$id'")
            ->exec();
        $rec_id = $res[0]['recurrent'];
        $user_id = $res[0]['user_id'];
        $userList = $this->getResArr();
        $recc = $pdo->select("id")
            ->from("APPOINTMENTS")
            ->where("recurrent = '$rec_id'")
            ->exec();
        array_push($res, $recc);
        array_push($res, $userList);
        array_push($res, $user_id);
        return $res;
    }
    public function deleteUser($userId){
        $pdo = PDOModel::connect();
        $res = $pdo ->delete("EMPLOYEES")
            ->where("user_id = '$userId'")
            ->execInsert();
        if (0 == count($res)) {
            return false;
        } else {
            return true;
        }
    }

    public function checkAppointments($firstDay, $lastDay, $room_id){
        $pdo = PDOModel::connect();
        $res = $pdo->select("start_time_ms, end_time_ms")
            ->from("APPOINTMENTS")
            ->where("start_time_ms ='$firstDay' AND end_time_ms ='$lastDay' AND room_id = '$room_id'")
            ->exec();
        if (0 == count($res)) {
            return true;
        } else {
            return false;
        }
    }

    public function insertAppointment($user_id, $start, $end, $specifics, $duration, $room_id){
        $pdo = PDOModel::connect();
        if (empty($_POST['recurringRes'])) {
            $this->resID = $pdo->insert("APPOINTMENTS")
                ->fields("user_id, room_id, start_time_ms, end_time_ms, description")
                ->values("'$user_id', '$room_id', '$start', '$end', '$specifics'")
                ->execInsertWithLastID();
        } else {
            $recType = (int)$_POST['recurringRes'];
            $msInDay = 1000 * 60 * 60 * 24;
            $start = $start;
            $end = $end;
            $recID = 0;
            for ($i = 0; $i <= $duration; $i++) {
                if (0 == $i) {
                    $this->resID = $pdo->insert("APPOINTMENTS")
                        ->fields("user_id, room_id, start_time_ms, end_time_ms, description")
                        ->values("'$user_id', '$room_id', '$start', '$end', '$specifics'")
                        ->execInsertWithLastID();
                    $recID = $this->resID;
                    $pdo->update("APPOINTMENTS")
                        ->set("recurrent = '$recID'")
                        ->where("id = '$this->resID'")
                        ->execInsert();
                } else {
                    $this->resID = $pdo->insert("APPOINTMENTS")
                        ->fields("user_id, room_id, start_time_ms, end_time_ms, recurrent, description")
                        ->values("'$user_id', '$room_id', '$start', '$end', '$recID', '$specifics'")
                        ->execInsertWithLastID();
                }

                $start = ($recType * $msInDay) + $start;
                $end = ($recType * $msInDay) + $end;
            }
        }

        if (empty($this->resID)) {
            return false;
        } else {
            return true;
        }
    }

    public function checkDelete($user_id, $app_id){
        $pdo = PDOModel::connect();
        $res = $pdo->select("id")
            ->from("APPOINTMENTS")
            ->where("user_id ='$user_id' AND id ='$app_id'")
            ->exec();
        if (0 == count($res)) {
            return false;
        } else {
            return true;
        }
    }

    public function deleteAppointment($app_id, $recur){
        $pdo = PDOModel::connect();
        if (1 == $recur) {
            $rec_query = $pdo->select("recurrent")
                ->from("APPOINTMENTS")
                ->where("id = '$app_id'")
                ->exec();
            $rec_id = $rec_query[0]['recurrent'];
            $currentTime = time()*1000;
            $res = $pdo ->delete("APPOINTMENTS")
                ->where("recurrent = '$rec_id' AND start_time_ms > '$currentTime'")
                ->execInsert();
            return true;
        } else if (0 == $recur){
            $res = $pdo ->delete("APPOINTMENTS")
                ->where("id = '$app_id'")
                ->execInsert();
            if (0 == count($res)) {
                return false;
            } else {
                return true;
            }
        }

    }

    public function updateAppointment($id, $start, $end){
        $pdo = PDOModel::connect();
        $pdo->update("APPOINTMENTS")
            ->set("start_time_ms = '$start' AND end_time_ms = '$end'")
            ->where("id = '$id'")
            ->execInsert();
    }

    public function getRooms(){
        $pdo = PDOModel::connect();
        $res = $pdo->select("room_id, room_name")
            ->from("rooms")
            ->exec();
        return $res;
    }
    /**
     * @return array
     */
    public function getResArr()
    {
        return $this->resArr;
    }

} 