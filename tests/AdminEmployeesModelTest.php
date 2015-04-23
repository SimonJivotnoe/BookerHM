<?php
include dirname(__FILE__). '/../models/AdminEmployeesModel.php';
include dirname(__FILE__). '/../models/AgentPDOModel.php';
include dirname(__FILE__). '/../models/DataContModel.php';
include dirname(__FILE__). '/../models/ValidatorModel.php';
include dirname(__FILE__). '/../view/SubstitutionModel.php';
include dirname(__FILE__). '/../models/PDOModel.php';
include dirname(__FILE__). '/../config.php';

class AdminEmployeesModelTest extends PHPUnit_Framework_TestCase {
	
	public function testdeleteUser(){
		$obj = new AdminEmployeesModel();
		$user_id = 779;
		$this->assertTrue(($obj->deleteUser($user_id)));

	}

	public function testaddEditUser(){
		$obj = new AdminEmployeesModel();
		$user_id = 779;
		$_GET['name'] = 'test7776';
		$_GET['pass'] = 'pass7776';
		$_GET['mail'] = 'test6@mail.ru';
		$action = 'add';
		$delete = 'delete';
		$this->assertTrue(($obj->addEditUser($action, $user_id)));
		$this->assertTrue(($obj->addEditUser($delete, $user_id)));
		}

}
