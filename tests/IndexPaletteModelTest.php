<?php
include dirname(__FILE__). '/../models/IndexPaletteModel.php';
include dirname(__FILE__). '/../models/DataContModel.php';
include dirname(__FILE__). '/../config.php';
class IndexPaletteModelTest extends PHPUnit_Framework_TestCase {
	
	public function testgetArr(){
		$obj = new IndexPaletteModel();
		$this->assertTrue(is_array($obj->getArr()));
		}
}
