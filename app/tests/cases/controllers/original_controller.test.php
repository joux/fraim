<?php 
/* SVN FILE: $Id$ */
/* OriginalController Test cases generated on: 2009-07-13 14:07:49 : 1247488669*/
App::import('Controller', 'Original');

class TestOriginal extends OriginalController {
	var $autoRender = false;
}

class OriginalControllerTest extends CakeTestCase {
	var $Original = null;

	function startTest() {
		$this->Original = new TestOriginal();
		$this->Original->constructClasses();
	}

	function testOriginalControllerInstance() {
		$this->assertTrue(is_a($this->Original, 'OriginalController'));
	}

	function endTest() {
		unset($this->Original);
	}
}
?>