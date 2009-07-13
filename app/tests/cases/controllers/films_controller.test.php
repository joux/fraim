<?php 
/* SVN FILE: $Id$ */
/* FilmsController Test cases generated on: 2009-07-13 14:07:41 : 1247489441*/
App::import('Controller', 'Films');

class TestFilms extends FilmsController {
	var $autoRender = false;
}

class FilmsControllerTest extends CakeTestCase {
	var $Films = null;

	function startTest() {
		$this->Films = new TestFilms();
		$this->Films->constructClasses();
	}

	function testFilmsControllerInstance() {
		$this->assertTrue(is_a($this->Films, 'FilmsController'));
	}

	function endTest() {
		unset($this->Films);
	}
}
?>