<?php
include dirname(__FILE__). '/../models/EmployeesPaletteModel.php';
include dirname(__FILE__). '/../models/AgentPDOModel.php';
include dirname(__FILE__). '/../models/DataContModel.php';
include dirname(__FILE__). '/../models/ValidatorModel.php';
include dirname(__FILE__). '/../view/SubstitutionModel.php';
include dirname(__FILE__). '/../models/PDOModel.php';
include dirname(__FILE__). '/../config.php';

class EmployeesPaletteModelTest extends PHPUnit_Framework_TestCase {
	
	public function testgetArr(){
		$obj = new EmployeesPaletteModel();
		$objD = DataContModel::getInstance();
		$objD->setData(array());
		$user_id = 779;
		$this->assertTrue(is_array(($obj->getArr())));

	}

}

