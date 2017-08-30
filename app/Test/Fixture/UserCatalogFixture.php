<?php
/**
 * UserCatalogFixture
 *
 */
class UserCatalogFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'year' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 2, 'key' => 'primary'),
		'points' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4),
		'rank' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 3, 'key' => 'index'),
		'indexes' => array(
			'user_id' => array('column' => array('user_id', 'year'), 'unique' => 1),
			'rank' => array('column' => 'rank', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_german1_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'user_id' => 1,
			'year' => 1,
			'points' => 1,
			'rank' => 1
		),
	);

}
