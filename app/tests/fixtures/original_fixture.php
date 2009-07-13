<?php 
/* SVN FILE: $Id$ */
/* Original Fixture generated on: 2009-07-13 14:07:39 : 1247488239*/

class OriginalFixture extends CakeTestFixture {
	var $name = 'Original';
	var $table = 'originals';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'film_id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 5),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id'  => 1,
		'film_id'  => 1
	));
}
?>