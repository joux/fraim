<?php 
/* SVN FILE: $Id$ */
/* User Fixture generated on: 2009-07-13 14:07:43 : 1247488303*/

class UserFixture extends CakeTestFixture {
	var $name = 'User';
	var $table = 'users';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 5, 'key' => 'primary'),
		'name' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 64),
		'email' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 128),
		'password' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 64),
		'reset_token' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 64),
		'reset_token_expires' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'group' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 64),
		'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id'  => 1,
		'name'  => 'Lorem ipsum dolor sit amet',
		'email'  => 'Lorem ipsum dolor sit amet',
		'password'  => 'Lorem ipsum dolor sit amet',
		'reset_token'  => 'Lorem ipsum dolor sit amet',
		'reset_token_expires'  => '2009-07-13 14:31:43',
		'group'  => 'Lorem ipsum dolor sit amet',
		'created'  => '2009-07-13 14:31:43'
	));
}
?>