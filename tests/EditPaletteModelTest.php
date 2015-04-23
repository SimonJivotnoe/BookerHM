<?php
include dirname(__FILE__). '/../models/EditPaletteModel.php';
include dirname(__FILE__). '/../models/AgentPDOModel.php';
include dirname(__FILE__). '/../models/DataContModel.php';
include dirname(__FILE__). '/../view/SubstitutionModel.php';
include dirname(__FILE__). '/../models/PDOModel.php';
include dirname(__FILE__). '/../config.php';
class EditPaletteModelTest extends PHPUnit_Framework_TestCase {
	
	public function testgetArr(){
		$data = DataContModel::getInstance();
		$arr = array(
		array(
		'start_time_ms' => 10, 'end_time_ms' => 9,
		'submitted' => 7, 'description' => ''),
		array(array(1)),
		array(array('user_name' => 'user1', 'user_id' => 9)),
		array()		
		);
		$data->setData($arr);
		$obj = new EditPaletteModel();
		$this->assertTrue(is_array($obj->getArr()));
		}
}
