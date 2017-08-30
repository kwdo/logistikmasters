<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Profile $Profile
 * @property UserCatalog $UserCatalog
 * @property UserCatalogs2011 $UserCatalogs2011
 * @property UserCatalogsOld $UserCatalogsOld
 * @property UserCatalogsTmp $UserCatalogsTmp
 * @property UserPoint $UserPoint
 * @property Form $Form
 * @property Question $Question
 */
class User extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'username' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Bitte gib einen Usernamen an',
				//'allowEmpty' => false,
				//'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'Dieser Username ist bereits vergeben',
            ),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Bitte gebe eine gültige E-Mail Adresse an',
				//'allowEmpty' => false,
				//'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
            'emailcompare' => array(
                'rule' => array('compareEmail'),
                'message' => 'Die E-Mail Adressen stimmen nicht überein'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'Diese E-Mail Adresse ist bereits angemeldet',
            ),
		),
        'email_repeat' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Bitte wiederhole Deine E-Mail Adresse',
                'allowEmpty' => false,
                //'required' => true,
                //'last' => false, // Stop validation after this rule
                'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'user')),
                'message' => 'Bitte ein Rolle angeben',
                'allowEmpty' => false
            )
        ),
        'password' => array(
            'notempty' => array(
                'rule' => array('minLength', 6),
                'message' => 'Das Passwort muss mindestens 6 Zeichen lang sein',
                'allowEmpty' => false,
                'required' => true,
                'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'passwordcompare' => array(
                'rule' => array('comparePasswords'),
                'message' => 'Die Passwörter stimmen nicht überein'
            ),
        ),
        'password_repeat' => array(
            'notempty' => array(
                'rule' => array('minLength', 6),
                'message' => 'Bitte wiederhole das Passwort',
                'allowEmpty' => false,
                'required' => true,
                'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasOne associations
 *
 * @var array
 */
	public $hasOne = array(
		'Profile' => array(
			'className' => 'Profile',
			'foreignKey' => 'user_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'UserCatalog' => array(
			'className' => 'UserCatalog',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'UserPoint' => array(
			'className' => 'UserPoint',
			'foreignKey' => 'user_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);


/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
	);


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Form' => array(
			'className' => 'Form',
			'joinTable' => 'forms_users',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'form_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'Question' => array(
			'className' => 'Question',
			'joinTable' => 'questions_users',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'question_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);


    public function beforeSave($options = array()) {
        if (!empty($this->data['User']['password'])) {
            $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        }

        if (!isset($this->data['User']['role'])) {
            $this->data['User']['role'] = 'user';
        }
        return true;
    }

    public function comparePasswords() {
        return ($this->data[$this->name]['password'] == $this->data[$this->name]['password_repeat']);
    }

    public function compareEmail() {
        return ($this->data[$this->name]['email'] == $this->data[$this->name]['email_repeat']);
    }

}
