<?php
App::uses('FormsUser', 'Model');

/**
 * FormsUser Test Case
 *
 */
class FormsUserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.forms_user',
		'app.form',
		'app.question',
		'app.user',
		'app.profile',
		'app.user_catalog',
		'app.user_catalogs2011',
		'app.user_catalogs_old',
		'app.user_catalogs_tmp',
		'app.user_point',
		'app.questions_user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->FormsUser = ClassRegistry::init('FormsUser');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FormsUser);

		parent::tearDown();
	}

}
