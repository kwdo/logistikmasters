<?php

App::uses('AppModel', 'Model');

/**
 * User Model
 *
 * @property UserProfile $UserProfile
 * @property UserCatalog $UserCatalog
 * @property UserCatalogs2011 $UserCatalogs2011
 * @property UserCatalogsOld $UserCatalogsOld
 * @property UserCatalogsTmp $UserCatalogsTmp
 * @property UserPoint $UserPoint
 * @property Form $Form
 * @property Question $Question
 */
class User extends AppModel
{
    public $actsAs = array('Containable','Utils.SoftDelete');
    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'username' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Bitte gib einen Usernamen an'
                //'allowEmpty' => false,
                //'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'Dieser Username ist bereits vergeben'
            )
        ),
        'apprentice' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Bitte bestätige hier an'
                //'allowEmpty' => false,
                //'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            )
        ),
        'precondition' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Bitte bestätige hier an'
                //'allowEmpty' => false,
                //'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            )
        ),
        'email' => array(
            'email' => array(
                'rule' => array('email'),
                'message' => 'Bitte gebe eine gültige E-Mail Adresse an'
                //'allowEmpty' => false,
                //'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'emailcompare' => array(
                'rule' => array('compareEmail'),
                'message' => 'Die E-Mail Adressen stimmen nicht überein',
                'on' => 'create'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'Diese E-Mail Adresse ist bereits angemeldet'
            )
        ),
        'email_repeat' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Bitte wiederhole Deine E-Mail Adresse',
                'allowEmpty' => false,
                //'required' => true,
                //'last' => false, // Stop validation after this rule
                'on' => 'create' // Limit validation to 'create' or 'update' operations
            )
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
                'required' => false,
                'on' => null
            ),
            'passwordcompare' => array(
                'rule' => array('comparePasswords'),
                'message' => 'Die Passwörter stimmen nicht überein',
                'on' => null
            )
        ),
        'password_repeat' => array(
            'notempty' => array(
                'rule' => array('minLength', 6),
                'message' => 'Bitte wiederholen Sie das Passwort',
                'allowEmpty' => false,
                'required' => false,
                'on' => null
            )
        )
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasOne associations
     *
     * @var array
     */
    public $hasOne = array(
        'UserProfile' => array(
            'className' => 'UserProfile',
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
        'Forum.Profile'
    );



    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Forum.Access',
        'Forum.Moderator',
        'UserPoint' => array(
            'className' => 'UserPoint',
            'foreignKey' => 'user_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
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
        ),
        'Year' => array(
            'className' => 'Year',
            'joinTable' => 'users_years',
            'foreignKey' => 'user_id',
            'associationForeignKey' => 'year_id',
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

    public function beforeSave($options = array())
    {
        if (!empty($this->data['User']['password'])) {
            $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        }

        if (!isset($this->data['User']['role'])) {
            $this->data['User']['role'] = 'user';
        }
        return true;
    }

    public function comparePasswords()
    {
        return ($this->data[$this->name]['password'] == $this->data[$this->name]['password_repeat']);
    }

    public function compareEmail()
    {
        return ($this->data[$this->name]['email'] == $this->data[$this->name]['email_repeat']);
    }

    public function setPoints($year)
    {
        // reset points
	    $sql = "UPDATE `forms_users` SET `points`=IF((SELECT `year` FROM `forms` WHERE `id`=`forms_users`.`form_id` LIMIT 1) = $year, 0, `points`)";
	    $this->query($sql);

	    // calc points
	    $sql = "UPDATE forms_users f
					LEFT JOIN forms fo ON(f.form_id=fo.id)
				SET points=(
					SELECT SUM(q.points) FROM questions_users u
						LEFT JOIN answers a ON(a.id=u.answer_id AND a.correct=1)
						LEFT JOIN questions q ON(q.id=a.question_id)
					WHERE u.user_id=f.user_id AND q.form_id=f.form_id)
				WHERE f.next_question=0 AND fo.`year`=$year";
        $this->query($sql);

        $this->countTls();
    }

    public function setStats($year)
    {
	    // reset points
	    $sql = "UPDATE `user_points` SET `points`=0 WHERE `year` = $year";
	    $this->query($sql);

	    // cache points
        $sql = "UPDATE user_points u
				SET
					points=(SELECT SUM(f.points) FROM forms_users f INNER JOIN forms fo ON fo.id=f.form_id WHERE f.user_id=u.user_id AND fo.`year` = $year),
					finished=(SELECT COUNT(*) FROM forms_users f INNER JOIN forms fo ON fo.id=f.form_id WHERE next_question=0 AND f.user_id=u.user_id AND fo.`year` = $year)
					WHERE u.`year` = $year
				";
        $this->query($sql);
    }


    /**
     * counts how many catalogs are completed by the user, ranked in top 100 and stores its result to `user_profiles`.`tls`
     */
    function countTls()
    {
        $sql = "UPDATE `user_profiles` AS `up` SET `up`.`tls` = (SELECT COUNT(*) FROM `user_catalogs` AS `uc` WHERE `uc`.`user_id` = `up`.`user_id`)";
        $this->query($sql);
    }

}
