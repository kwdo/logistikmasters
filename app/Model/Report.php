<?php
App::uses('AppModel', 'Model');
/**
 * Report Model
 *
 * @property User $User
 */
class Report extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'created';

    /**
     * Default Order field
     *
     * @var array
     */
    public $order = array("Report.created" => "DESC");


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
