<?php 
/* SVN FILE: $Id$ */
/* Original Test cases generated on: 2009-07-13 14:07:39 : 1247488239*/
App::import('Model', 'Original');

class OriginalTestCase extends CakeTestCase {
	var $Original = null;
	var $fixtures = array('app.original', 'app.film', 'app.copy');

	function startTest() {
		$this->Original =& ClassRegistry::init('Original');
	}

	function testOriginalInstance() {
		$this->assertTrue(is_a($this->Original, 'Original'));
	}

	function testOriginalFind() {
		$this->Original->recursive = -1;
		$results = $this->Original->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Original' => array(
			'id'  => 1,
			'film_id'  => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>