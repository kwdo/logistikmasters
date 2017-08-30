<?php
App::uses('AppModel', 'Model');
/**
 * School Model
 *
 * @property SchoolCity $SchoolCity
 * @property UserProfile $UserProfile
 */
class School extends AppModel
{

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';

    /**
     * Default Order field
     *
     * @var array
     */
    public $order = array("School.sorting" => "ASC", "School.name" => "ASC");

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'school_city_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'SchoolCity' => array(
            'className' => 'SchoolCity',
            'foreignKey' => 'school_city_id',
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
        'UserProfile' => array(
            'className' => 'UserProfile',
            'foreignKey' => 'school_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => 'SELECT UserProfile.*, User.* FROM user_profiles as UserProfile, users as User
                        WHERE UserProfile.user_id = User.id
                        AND  User.doubleoptin=1
                        AND  UserProfile.school_id IN ({$__cakeID__$}) ORDER BY UserProfile.surname',
            'counterQuery' => ''
        )
    );

}
