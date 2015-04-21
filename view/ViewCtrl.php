<?php

/**
 * Class ViewCtrl
 */
class ViewCtrl
{
    /**
     *
     */
    public function __construct()
    {
        $objView = DataContModel::getInstance();
        $page = $objView->getStartPage();
        if (empty ($page)) {
            $res = $objView->getData();
            if (!empty($res)) {
                header(HEADER);
                echo json_encode($res);
            } else {
                header(HEADER);
                echo json_encode(array());
            }

        } else {
            $lang = '';
            if (isset($_POST['lang']))
            {
                $lang = $_POST['lang'];
                setcookie('lang', $_POST['lang']);

            } else {
                $lang = $_COOKIE['lang'];
            }
            if ($lang == null) {
                $lang = 'en';
            }
            $objLang = new LangModel($lang);
            $langArr = $objLang->getLang();
            //$flag = $objView->getInfoFlag();
            $objSubstitution = new SubstitutionModel();
            $result = $objSubstitution->parseAndReplace($page, $langArr);
            // $finRes = $objSubstitution->langReplace($result, $langArr);
            header(HEADER);
            echo $result;
        }

    }

} 