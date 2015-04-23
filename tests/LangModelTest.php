<?php
include dirname(__FILE__). '/../models/LangModel.php';
include dirname(__FILE__). '/../models/AgentPDOModel.php';
include dirname(__FILE__). '/../config.php';
class LangModelTest extends PHPUnit_Framework_TestCase {
	
	public function testgetArr(){
		$lang = 'en';	
		$obj = new LangModel($lang);
		$this->assertTrue(is_array($obj->getLang()));
		}
}
