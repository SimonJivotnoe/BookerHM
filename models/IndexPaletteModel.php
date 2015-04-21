<?php


class IndexPaletteModel {
    private $repArr = array();

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
        $arr = $obj->getData();

        if (!empty($arr)) {
            return $arr;
        } else {
            return $this->repArr;
        }
    }
} 