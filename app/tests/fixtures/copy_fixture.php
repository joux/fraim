<?php 
/* SVN FILE: $Id$ */
/* Copy Fixture generated on: 2009-07-13 14:07:09 : 1247487789*/

class CopyFixture extends CakeTestFixture {
	var $name = 'Copy';
	var $table = 'copies';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'original_id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'user_id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 5),
		'description' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 256),
		'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id'  => 1,
		'original_id'  => 1,
		'user_id'  => 1,
		'description'  => 'Lorem ipsum dolor sit amet',
		'created'  => '2009-07-13 14:23:09'
	));
}
?>