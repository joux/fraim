<?php 
/* SVN FILE: $Id$ */
/* CopiesController Test cases generated on: 2009-07-13 14:07:32 : 1247489432*/
App::import('Controller', 'Copies');

class TestCopies extends CopiesController {
	var $autoRender = false;
}

class CopiesControllerTest extends CakeTestCase {
	var $Copies = null;

	function startTest() {
		$this->Copies = new TestCopies();
		$this->Copies->constructClasses();
	}

	function testCopiesControllerInstance() {
		$this->assertTrue(is_a($this->Copies, 'CopiesController'));
	}

	function endTest() {
		unset($this->Copies);
	}
}
?>