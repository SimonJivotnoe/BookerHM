<?php


class EditPaletteModel {
    private $repArr = array();
    public function __construct()
    {

    }

    public function getArr()
    {
        $obj = DataContModel::getInstance();
        $sub = new SubstitutionModel();
        $arr = $obj->getData();
        $this->repArr['%START%'] = $arr[0]['start_time_ms'];
        $this->repArr['%END%'] = $arr[0]['end_time_ms'];
        $this->repArr['%SUBMITTED%'] = $arr[0]['submitted'];
        $this->repArr['%DESCRIPTION%'] = $arr[0]['description'];
        $userList = '';
        foreach ($arr[2] as $key => $val) {
            if ($arr[3] == $val['user_id']) {
                $userList .= '<option selected><strong>'.$val['user_name'].'</strong></option>';
            } else {
                $userList .= '<option>'.$val['user_name'].'</option>';
            }
        }

        $this->repArr['%USER%'] = $userList;
        if(!empty($arr[1])){
            $recc = $sub->subHTMLReplace('ifRecurrent.html',array() );
            $this->repArr['%RECURRENT%'] = $recc;
        } else {
            $this->repArr['%RECURRENT%'] = '';
        }
        if(($arr[0]['start_time_ms'] / 1000) > time()){
            $buttons = $sub->subHTMLReplace('EditUpdateButtons.html',array('%ID%' => $arr[0]['id']) );
            $this->repArr['%BUTTONS%'] = $buttons;
        } else {
            $this->repArr['%BUTTONS%'] = '';
        }

        //var_dump($this->repArr);
        return $this->repArr;
    }
} 