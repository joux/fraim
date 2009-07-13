<?php 
/* SVN FILE: $Id$ */
/* CopyController Test cases generated on: 2009-07-13 14:07:42 : 1247488662*/
App::import('Controller', 'Copy');

class TestCopy extends CopyController {
	var $autoRender = false;
}

class CopyControllerTest extends CakeTestCase {
	var $Copy = null;

	function startTest() {
		$this->Copy = new TestCopy();
		$this->Copy->constructClasses();
	}

	function testCopyControllerInstance() {
		$this->assertTrue(is_a($this->Copy, 'CopyController'));
	}

	function endTest() {
		unset($this->Copy);
	}
}
?>