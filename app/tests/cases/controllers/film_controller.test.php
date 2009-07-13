<?php 
/* SVN FILE: $Id$ */
/* FilmController Test cases generated on: 2009-07-13 14:07:35 : 1247488655*/
App::import('Controller', 'Film');

class TestFilm extends FilmController {
	var $autoRender = false;
}

class FilmControllerTest extends CakeTestCase {
	var $Film = null;

	function startTest() {
		$this->Film = new TestFilm();
		$this->Film->constructClasses();
	}

	function testFilmControllerInstance() {
		$this->assertTrue(is_a($this->Film, 'FilmController'));
	}

	function endTest() {
		unset($this->Film);
	}
}
?>