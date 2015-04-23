<?php
include dirname(__FILE__). '/../models/BookerPaletteModel.php';
include dirname(__FILE__). '/../models/AgentPDOModel.php';
include dirname(__FILE__). '/../models/DataContModel.php';
include dirname(__FILE__). '/../view/SubstitutionModel.php';
include dirname(__FILE__). '/../models/PDOModel.php';
include dirname(__FILE__). '/../config.php';

class BookerPaletteModelTest extends PHPUnit_Framework_TestCase {
	
	public function testgetArr(){
		$data = DataContModel::getInstance();
		$arr = array(
		array('user_name' => 'user1')	
		);
		$data->setData($arr);
		$obj = new BookerPaletteModel();
		$this->assertTrue(is_array($obj->getArr()));
		}
}
