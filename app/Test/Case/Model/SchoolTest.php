<?php
App::uses('School', 'Model');

/**
 * School Test Case
 *
 */
class SchoolTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.school',
		'app.school_city',
		'app.profile',
		'app.user',
		'app.user_catalog',
		'app.user_catalogs2011',
		'app.user_catalogs_old',
		'app.user_catalogs_tmp',
		'app.user_point',
		'app.form',
		'app.question',
		'app.answer',
		'app.questions_user',
		'app.forms_user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->School = ClassRegistry::init('School');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->School);

		parent::tearDown();
	}

}
