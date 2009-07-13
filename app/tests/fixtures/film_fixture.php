<?php 
/* SVN FILE: $Id$ */
/* Film Fixture generated on: 2009-07-13 14:07:38 : 1247487818*/

class FilmFixture extends CakeTestFixture {
	var $name = 'Film';
	var $table = 'films';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 5, 'key' => 'primary'),
		'user_id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 5),
		'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'description' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 256),
		'title' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 128),
		'single_frames_ready' => array('type'=>'boolean', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id'  => 1,
		'user_id'  => 1,
		'created'  => '2009-07-13 14:23:38',
		'description'  => 'Lorem ipsum dolor sit amet',
		'title'  => 'Lorem ipsum dolor sit amet',
		'single_frames_ready'  => 1
	));
}
?>