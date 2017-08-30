<?php
App::uses('AppModel', 'Model');
/**
 * Profile Model
 *
 * @property User $User
 * @property School $School
 */
class Profile extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'firstname' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Bitte ergänze Deinen Vornamen',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'surname' => array(
			'notempty' => array(
				'rule' => array('notempty'),
                'message' => 'Bitte ergänze Deinen Nachnamen',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'street' => array(
			'notempty' => array(
				'rule' => array('notempty'),
                'message' => 'Bitte ergänze Deine Straße',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'zip' => array(
			'notempty' => array(
				'rule' => array('notempty'),
                'message' => 'Bitte ergänze Deine Postleitzahl',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'city' => array(
			'notempty' => array(
				'rule' => array('notempty'),
                'message' => 'Bitte ergänze Deine Stadt',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'school_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
                'message' => 'Bitte ergänze Deine Hochschule',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
                'message' => 'Bitte ergänze Deine Hochschule',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
        'school_name' => array(
            'check_schoolid' => array(
                'rule' => array('checkSchoolId'),
                'message' => 'Bitte gebe Deine Hochschule an'
            ),
        ),
		'school_city_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
                'message' => 'Bitte ergänze den Ort Deiner Hochschule',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
                'message' => 'Bitte ergänze den Ort Deiner Hochschule',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
        'school_city_name' => array(
            'check_schoolcityid' => array(
                'rule' => array('checkSchoolCityId'),
                'message' => 'Bitte gebe den Ort Deiner Hochschule an'
            ),
        ),

		'company' => array(
			'notempty' => array(
				'rule' => array('notempty'),
                'message' => 'Bitte ergänze Deinen Ausbildungsbetrieb',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'company_city' => array(
			'notempty' => array(
				'rule' => array('notempty'),
                'message' => 'Bitte ergänze den Ort Deines Ausbildungsbetriebes',
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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'School' => array(
			'className' => 'School',
			'foreignKey' => 'school_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'SchoolCity' => array(
			'className' => 'SchoolCity',
			'foreignKey' => 'school_city_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);


    public function checkSchoolCityId() {
        if(($this->data[$this->name]['school_city_id'] == 96) && !$this->data[$this->name]['school_city_name']){
            return false;
        }else{
            return true;
        }
    }

    public function checkSchoolId() {
        if(($this->data[$this->name]['school_id'] == 102) && empty($this->data[$this->name]['school_name'])){
            return false;
        }else{
            return true;
        }
    }

    public function beforeSave($options = array()) {
        /*
            Wenn der Berufsschul Ort nicht in der Liste ist, fügen wir den manuell gesetzten hinzu. Vorher wird aber gecheckt,
            ob der manuell eingegebene Ort nicht doch dabei ist.
        */
        if ($this->data['Profile']['school_city_id'] == 96 && !empty($this->data['Profile']['school_city_name'])) {
            $school_city_name = trim($this->data['Profile']['school_city_name']);
            $id = $this->SchoolCity->findByName($school_city_name);
            if (!$id['SchoolCity']['id']) {
                $this->SchoolCity->create();
                $this->SchoolCity->save(array('name' => $school_city_name,'sorting' => 0));
                $id['SchoolCity']['id'] = $this->SchoolCity->id;
            }
            $this->data['Profile']['school_city_id'] = $id['SchoolCity']['id'];
            unset($this->data['Profile']['school_city_name']);
        }

        /*
            Wenn die Berufsschule nicht in der Liste ist, fügen wir die manuell gesetzte hinzu. Vorher wird aber gecheckt,
            ob die manuell eingegebene Schule nicht doch dabei ist.
        */
        if ($this->data['Profile']['school_id'] == 102 && !empty($this->data['Profile']['school_name'])) {
               $school_name = trim($this->data['Profile']['school_name']);
               $id = $this->School->findByName($school_name);
               if (!$id['School']['id']) {
                    $this->School->create();
                    $this->School->save(array('name' => $school_name, 'school_city_id' => $this->data['Profile']['school_city_id'], 'sorting' => 0));
                    $id['School']['id'] = $this->School->id;
                }
                $this->data['Profile']['school_id'] = $id['School']['id'];
                unset($this->data['Profile']['school_name']);
         }

        return true;
    }
}
