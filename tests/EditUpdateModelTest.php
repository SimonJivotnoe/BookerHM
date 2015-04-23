<?php
include dirname(__FILE__). '/../models/EditUpdateModel.php';
include dirname(__FILE__). '/../models/AgentPDOModel.php';
include dirname(__FILE__). '/../models/DataContModel.php';
include dirname(__FILE__). '/../models/ValidatorModel.php';
include dirname(__FILE__). '/../view/SubstitutionModel.php';
include dirname(__FILE__). '/../models/PDOModel.php';
include dirname(__FILE__). '/../config.php';

class EditUpdateModelTest extends PHPUnit_Framework_TestCase {
	
	public function testdeleteBuilder(){
		$obj = new EditUpdateModel();
		$user_id = 1111;
		$app_id = 1111;
		$recur = 0;
		$this->assertEquals(null, $obj->deleteBuilder($user_id, $app_id, $recur));
		}

	public function testupdateBuilder(){
		$obj = new EditUpdateModel();
		$user_id = 1111;
		$recur = 0;
		$_POST['app_id'] = 777; 
		$_POST['room_id'] = 777; 
		$_POST['startHour'] = 777; 
		$_POST['startMin'] = 777; 
		$_POST['endHour'] = 777; 
		$_POST['endMin'] = 777; 
		$_POST['description'] = ''; 
		$this->assertEquals(null, $obj->updateBuilder($recur, $user_id));
		}

}
