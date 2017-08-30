<?php
App::uses('Form', 'Model');

/**
 * Form Test Case
 *
 */
class FormTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.form',
		'app.question',
		'app.user',
		'app.profile',
		'app.user_catalog',
		'app.user_catalogs2011',
		'app.user_catalogs_old',
		'app.user_catalogs_tmp',
		'app.user_point',
		'app.forms_user',
		'app.questions_user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Form = ClassRegistry::init('Form');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Form);

		parent::tearDown();
	}

}
