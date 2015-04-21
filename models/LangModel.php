<?php


/**
 * Class LangModel
 */
class LangModel {
    private $file;
    private $data;
    private $finalArr = array();

    /**
     * @param $lang
     */
    public function __construct($lang) {
        $this->file = simplexml_load_file('templates/lang/'.$lang.'.strings');
        $this->loadData();
    }

    /**
     *
     */
    private function loadData(){
        foreach ($this->file as $key => $val) {
            $this->data[] = (array)$val;
        }
    }

    /**
     * @return array
     */
    public function getLang(){
        $i = 1;
        $keyA = '';
        foreach ($this->data as $key => $val) {
            foreach ($val as $key => $val) {
                if ($i == 1) {
                    $keyA = '%'.$val.'%';
                    $this->finalArr[$keyA] = '';
                    $i++;
                } else {
                    $this->finalArr[$keyA] = $val;
                    $i = 1;
                }
            }
        }
        return $this->finalArr;
    }
} 