<?php

class Router
{

    public function __construct()
    {
        $objCookie = new CookiesModel();
        $checkCookie = $objCookie->read('lang');
        if ($checkCookie) {

        } else {
            $objCookie->add('lang', 'en');
        }
        session_start();
        if ( ! empty ($_GET[ 'page' ])) {
            $controllerNameInLowerCase = $_GET[ 'page' ];
        }
        if (isset($controllerNameInLowerCase)) {
            //after finding key "page" in array $_GET we assigns to $pageName value of key "page"
            //capitalizes the first letter of the value of the variable $pageName
            //$pageName = ucwords($controllerNameInLowerCase);
            $pageName = ucfirst($controllerNameInLowerCase);
            // create a path to the controller, for example C://bookshop/controllers/Book_ctrl.php
            $pagePass = realpath(__DIR__) . '/controllers/' . $pageName . '.php';
            //check whether there is such a file
            if (file_exists($pagePass)) {
                //launching the controller
                new $pageName;
            } else {
                new HomeCtrl();
            }
        } else {
            new HomeCtrl(); // else launching Home page
         }
        new ViewCtrl();
    }

}