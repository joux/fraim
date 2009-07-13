<?php 
/* SVN FILE: $Id$ */
/* Film Test cases generated on: 2009-07-13 14:07:38 : 1247487818*/
App::import('Model', 'Film');

class FilmTestCase extends CakeTestCase {
	var $Film = null;
	var $fixtures = array('app.film', 'app.user', 'app.original');

	function startTest() {
		$this->Film =& ClassRegistry::init('Film');
	}

	function testFilmInstance() {
		$this->assertTrue(is_a($this->Film, 'Film'));
	}

	function testFilmFind() {
		$this->Film->recursive = -1;
		$results = $this->Film->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Film' => array(
			'id'  => 1,
			'user_id'  => 1,
			'created'  => '2009-07-13 14:23:38',
			'description'  => 'Lorem ipsum dolor sit amet',
			'title'  => 'Lorem ipsum dolor sit amet',
			'single_frames_ready'  => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>