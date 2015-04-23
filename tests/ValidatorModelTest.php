<?php
include dirname(__FILE__). '/../models/ValidatorModel.php';
include dirname(__FILE__). '/../models/AgentPDOModel.php';
include dirname(__FILE__). '/../models/PDOModel.php';
include dirname(__FILE__). '/../config.php';
class ValidatorModelTest extends PHPUnit_Framework_TestCase {
	
	public function testformValidation(){
		$login = 'test';
		$pass = 'test11';
		$login2 = 'wefewfwefwefewfr';
		$pass2 = '1';
		$obj = new ValidatorModel();
		$this->assertTrue($obj->formValidation($login, $pass));
		$this->assertFalse($obj->formValidation($login2, $pass2));
		}
	public function testgetErrMess() {
		$obj = new ValidatorModel();
		$this->assertTrue(is_array($obj->getErrMess()));
		}	
	public function testgetVariablesArray(){
		$obj = new ValidatorModel();
		$this->assertTrue(is_array($obj->getVariablesArray()));
		}
	public function testcheckTime(){
		$obj = new ValidatorModel();
		$arr = array(0 => array('start_time_ms' => 10, 'end_time_ms' => 10));
		$start = 10;
		$end = 5;
		$start2 = 5;
		$end2 = 10;
		$this->assertTrue(is_int($obj->checkTime($arr,$start2, $end2 )));
		$this->assertTrue(is_int($obj->checkTime($arr, $start, $end)));
		}	
	
	}
