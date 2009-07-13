<?php 
/* SVN FILE: $Id$ */
/* UserController Test cases generated on: 2009-07-13 14:07:27 : 1247488647*/
App::import('Controller', 'User');

class TestUser extends UserController {
	var $autoRender = false;
}

class UserControllerTest extends CakeTestCase {
	var $User = null;

	function startTest() {
		$this->User = new TestUser();
		$this->User->constructClasses();
	}

	function testUserControllerInstance() {
		$this->assertTrue(is_a($this->User, 'UserController'));
	}

	function endTest() {
		unset($this->User);
	}
}
?>