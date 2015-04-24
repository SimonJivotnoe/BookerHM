<?php
include dirname(__FILE__). '/../models/AjaxTimeModel.php';
include dirname(__FILE__). '/../models/AgentPDOModel.php';
include dirname(__FILE__). '/../models/DataContModel.php';
include dirname(__FILE__). '/../models/ValidatorModel.php';
include dirname(__FILE__). '/../view/SubstitutionModel.php';
include dirname(__FILE__). '/../models/PDOModel.php';
include dirname(__FILE__). '/../config.php';

class AjaxTimeModelTest extends PHPUnit_Framework_TestCase {
	
	public function testcheckApp(){
		$obj = new AjaxTimeModel();
		$start = 10;
		$end = 10;
		$startDay = 10;
		$endDay = 10;
		$room_id = 10;
		$recType = 10;
		$duration = 10;
		$this->assertEquals(0, ($obj->checkApp($start, $end,
		$startDay, $endDay,
		$room_id, $recType, $duration)));

	}

	public function testinsertApp(){
		$obj = new AjaxTimeModel();
		$start = 10;
		$end = 10;
		$specifics = '';
		$duration = 10;
		$room_id = 5;
		$this->assertTrue($obj->insertApp($start, $end, $specifics,
		$duration, $room_id));

	}
}

