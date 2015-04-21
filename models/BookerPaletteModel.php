<?php


class BookerPaletteModel {
    private $repArr = array('%EMPLOYEELISTBUTTON%' => '',);

    /**
     *
     */
    public function __construct()
    {

    }

    /**
     * @return array
     */
    public function getArr()
    {
        $obj = DataContModel::getInstance();
        $objAgent = new AgentPDOModel();
        $arr = $obj->getData();
        //var_dump($arr);
        $role = $obj->getRole();
        $sub = new SubstitutionModel();
        if ($role) {
            $this->repArr['%EMPLOYEELISTBUTTON%'] = $sub->subHTMLReplace('employeeListButton.html',array());
        }
        $userList = '';
        foreach ($arr as $key => $val) {
            $userList .= '<option>'.$val['user_name'].'</option>';
        }
        $rooms = '';
        $roomsArr = $objAgent->getRooms();
        foreach ($roomsArr as $key => $val) {
            $rooms .= '<option value="'.$val['room_id'].'">'.$val['room_name'].'</option>';
        }
        $this->repArr['%ROOMS%'] = $rooms;
        $this->repArr['%MODAL%'] = $sub->subHTMLReplace('bookIt.html',array('%USERSLIST%' => $userList) );
        $this->repArr['%WELCOME%'] = $_SESSION['BookerLogin'];
        return $this->repArr;
    }
} 