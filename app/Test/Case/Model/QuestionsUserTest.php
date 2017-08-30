<?php
App::uses('QuestionsUser', 'Model');

/**
 * QuestionsUser Test Case
 *
 */
class QuestionsUserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.questions_user',
		'app.question',
		'app.form',
		'app.user',
		'app.profile',
		'app.school',
		'app.user_catalog',
		'app.user_catalogs2011',
		'app.user_catalogs_old',
		'app.user_catalogs_tmp',
		'app.user_point',
		'app.forms_user',
		'app.answer'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->QuestionsUser = ClassRegistry::init('QuestionsUser');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->QuestionsUser);

		parent::tearDown();
	}

}
