<?php


/**
 * Class Logoffctrl
 */
class LogOffCtrl {
    /**
     *
     */
    public function __construct() {
        $objSess = new SessionModel();
        $objView = DataContModel::getInstance();
        $res = $objSess->remove('BookerLogin');
        if ($res) {
            $objView->setData(array(0 => true));
           // header('Location: /index.php');
        } else {
            $objView->setData(array(0 => false));
        }
    }
} 
