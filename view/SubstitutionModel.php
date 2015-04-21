<?php


/**
 * Class SubstitutionModel
 */
class SubstitutionModel {

    /**
     *
     */
    public function __construct() {

    }

    /**
     * @param $page
     * @param $lang
     * @return string
     */
    public function parseAndReplace($page, $lang){
            $htmlToString = file_get_contents(TEMPLATES . $page[0]);
            $palette = $this->getPaletteName($page[0]).'PaletteModel';
            $palette = str_replace('"','',$palette);
            $palette = ucfirst($palette);						
            $objPalette = new $palette();
            $result = strtr($htmlToString, $objPalette->getArr());
            $resultLang = strtr($result, $lang);
            return $resultLang;
    }

    /**
     * @param $page
     * @return mixed
     */
    private function getPaletteName($page){
        return str_replace('.html', '',$page);
    }

    /**
     * @param $page
     * @param $arr
     * @return string
     */
    public function langReplace($page, $arr){
        $result = strtr($page, $arr);
        return $result;
    }

    /**
     * @param $page
     * @param $placeholders
     * @return string
     */
    public function subHTMLReplace($page, $placeholders){
        $htmlToString = file_get_contents(SUBTEMPLATES . $page);
        $result = strtr($htmlToString, $placeholders);
        return $result;
    }
} 

