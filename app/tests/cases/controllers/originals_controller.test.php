<?php 
/* SVN FILE: $Id$ */
/* OriginalsController Test cases generated on: 2009-07-13 14:07:50 : 1247489450*/
App::import('Controller', 'Originals');

class TestOriginals extends OriginalsController {
	var $autoRender = false;
}

class OriginalsControllerTest extends CakeTestCase {
	var $Originals = null;

	function startTest() {
		$this->Originals = new TestOriginals();
		$this->Originals->constructClasses();
	}

	function testOriginalsControllerInstance() {
		$this->assertTrue(is_a($this->Originals, 'OriginalsController'));
	}

	function endTest() {
		unset($this->Originals);
	}
}
?>