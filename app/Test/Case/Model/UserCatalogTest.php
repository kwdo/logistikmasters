<?php
App::uses('UserCatalog', 'Model');

/**
 * UserCatalog Test Case
 *
 */
class UserCatalogTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user_catalog',
		'app.user',
		'app.profile',
		'app.school',
		'app.school_city',
		'app.user_catalogs2011',
		'app.user_catalogs_old',
		'app.user_catalogs_tmp',
		'app.user_point',
		'app.form',
		'app.question',
		'app.answer',
		'app.questions_user',
		'app.forms_user',
		'app.old',
		'app.tmp'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UserCatalog = ClassRegistry::init('UserCatalog');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UserCatalog);

		parent::tearDown();
	}

}
