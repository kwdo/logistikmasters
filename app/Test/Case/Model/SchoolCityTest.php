<?php
App::uses('SchoolCity', 'Model');

/**
 * SchoolCity Test Case
 *
 */
class SchoolCityTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.school_city',
		'app.school'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SchoolCity = ClassRegistry::init('SchoolCity');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SchoolCity);

		parent::tearDown();
	}

}
