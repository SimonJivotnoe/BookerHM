<?php
include dirname(__FILE__). '/../models/EditPaletteModel.php';
include dirname(__FILE__). '/../models/AgentPDOModel.php';
include dirname(__FILE__). '/../models/DataContModel.php';
include dirname(__FILE__). '/../view/SubstitutionModel.php';
include dirname(__FILE__). '/../models/PDOModel.php';
include dirname(__FILE__). '/../config.php';

class ValidatorModelTest extends PHPUnit_Framework_TestCase {
	
	public function testgetArr(){
		$obj = new EditPaletteModel();
		$this->assertTrue(is_array($obj->getArr()));
		}
}

