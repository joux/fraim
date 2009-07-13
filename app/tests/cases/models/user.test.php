<?php 
/* SVN FILE: $Id$ */
/* User Test cases generated on: 2009-07-13 14:07:43 : 1247488303*/
App::import('Model', 'User');

class UserTestCase extends CakeTestCase {
	var $User = null;
	var $fixtures = array('app.user', 'app.copy', 'app.film');

	function startTest() {
		$this->User =& ClassRegistry::init('User');
	}

	function testUserInstance() {
		$this->assertTrue(is_a($this->User, 'User'));
	}

	function testUserFind() {
		$this->User->recursive = -1;
		$results = $this->User->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('User' => array(
			'id'  => 1,
			'name'  => 'Lorem ipsum dolor sit amet',
			'email'  => 'Lorem ipsum dolor sit amet',
			'password'  => 'Lorem ipsum dolor sit amet',
			'reset_token'  => 'Lorem ipsum dolor sit amet',
			'reset_token_expires'  => '2009-07-13 14:31:43',
			'group'  => 'Lorem ipsum dolor sit amet',
			'created'  => '2009-07-13 14:31:43'
		));
		$this->assertEqual($results, $expected);
	}
}
?>