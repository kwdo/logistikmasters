<?php

App::uses('AppModel', 'Model');

/**
 * UserProfile Model
 *
 * @property User $User
 * @property School $School
 */
class UserProfile extends AppModel
{

    public $actsAs = array('Upload.Upload' => array(
            'fileupload' => array(
                'fields' => array(
                    'dir' => 'fileupload_dir'
                )
            ),
        'picupload' => array(
            'fields' => array(
                'dir' => 'picupload_dir'
            ),
            'thumbnailSizes' => array(
                'large' => '160w',
                'thumb' => '60h'
            )
        ),
    ),
        'Containable',
        'Utils.SoftDelete'
    );

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'firstname'        => array(
            'notempty' => array(
                'rule'    => array('notempty'),
                'message' => 'Bitte ergänze Deinen Vornamen',
            ),
        ),
        'surname'          => array(
            'notempty' => array(
                'rule'    => array('notempty'),
                'message' => 'Bitte ergänze Deinen Nachnamen',
            ),
        ),
        'street'           => array(
            'notempty' => array(
                'rule'    => array('notempty'),
                'message' => 'Bitte ergänze Deine Straße',
            ),
        ),
        'zip'              => array(
            'notempty' => array(
                'rule'    => array('notempty'),
                'message' => 'Bitte ergänze Deine Postleitzahl',
            ),
        ),
        'city'             => array(
            'notempty' => array(
                'rule'    => array('notempty'),
                'message' => 'Bitte ergänze Deine Stadt',
            ),
        ),
        'school_id'        => array(
            'numeric'  => array(
                'rule'     => array('numeric'),
                'message'  => 'Bitte ergänze Deine Hochschule',
                'required' => true,
            ),
            'notempty' => array(
                'rule'     => array('notempty'),
                'message'  => 'Bitte ergänze Deine Hochschule',
                'required' => true,
            ),
        ),
        'school_name'      => array(
            'check_schoolid' => array(
                'rule'    => array('checkSchoolId'),
                'message' => 'Bitte gebe Deine Hochschule an'
            ),
        ),
        'school_city_id'   => array(
            'numeric'  => array(
                'rule'     => array('numeric'),
                'message'  => 'Bitte ergänze den Ort Deiner Hochschule',
                'required' => true,
            ),
            'notempty' => array(
                'rule'     => array('notempty'),
                'message'  => 'Bitte ergänze den Ort Deiner Hochschule',
                'required' => true,
            ),
        ),
        'school_city_name' => array(
            'check_schoolcityid' => array(
                'rule'    => array('checkSchoolCityId'),
                'message' => 'Bitte gebe den Ort Deiner Hochschule an'
            ),
        ),
        'company'           => array(
            'notempty' => array(
                'rule'    => array('notempty'),
                'message' => 'Bitte ergänze Deine Hochschulart',
            ),
        ),
        'company_city'      => array(
            'notempty' => array(
                'rule'    => array('notempty'),
                'message' => 'Bitte ergänze Deine Fachrichtung',
            ),
        ),
        'trainer_firstname' => array(
            'notempty' => array(
                'rule'       => array('minLength', 1),
                'allowEmpty' => false,
                'message'    => 'Bitte gib den Vornamen des Professors/Studienleiters an',
                'required'   => true
            )
        ),
        'trainer_surname'   => array(
            'notempty' => array(
                'rule'       => array('minLength', 1),
                'allowEmpty' => false,
                'message'    => 'Bitte gib den Nachnamen des Professors/Studienleiters an',
                'required'   => true
            )
        ),
	    'school2_city' => array(),
        'degree'           => array
        (
            'notempty' => array(
                'rule'    => array('checkDegreeSelect'),
                'message'  => 'Bitte Studiengang ergänzen',
                'required' => true
            )
        ),
        'degree_name'  => array
        (
            'notempty' => array(
                'rule'     => array('checkDegreeName'),
                'message' => 'Bitte Studiengang ergänzen',
            )
        )
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'User'       => array(
            'className'  => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields'     => '',
            'order'      => ''
        ),
        'School'     => array(
            'className'  => 'School',
            'foreignKey' => 'school_id',
            'counterCache' => true,
            'counterScope' => array('User.doubleoptin' => 1),
            'conditions' => '',
            'fields'     => '',
            'order'      => ''
        ),
        'SchoolCity' => array(
            'className'  => 'SchoolCity',
            'foreignKey' => 'school_city_id',
            'conditions' => '',
            'fields'     => '',
            'order'      => ''
        )
    );


    public $virtualFields = array(
        'virtual_degree' => 'IF(UserProfile.degree = "nicht in Liste", UserProfile.degree_name, UserProfile.degree)'
    );

    public function checkDegreeSelect()
    {
        return !empty($this->data[$this->name]['degree']);
    }

    public function checkDegreeName()
    {
        return !($this->data[$this->name]['degree'] == 'nicht in Liste'
            && empty($this->data[$this->name]['degree_name'])
        );
    }


    public function checkSchoolCityId()
    {
        if (($this->data[$this->name]['school_city_id'] == 244) && !$this->data[$this->name]['school_city_name'])
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function checkSchoolId()
    {
        if (($this->data[$this->name]['school_id'] == 354) && empty($this->data[$this->name]['school_name']))
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function beforeSave($options = array())
    {
        /*
          Wenn der Berufsschul Ort nicht in der Liste ist, fügen wir den manuell gesetzten hinzu. Vorher wird aber gecheckt,
          ob der manuell eingegebene Ort nicht doch dabei ist.
         */


        if (isset($this->data['UserProfile']['school_city_id']) && $this->data['UserProfile']['school_city_id'] == 244 && !empty($this->data['UserProfile']['school_city_name']))
        {


            $school_city_name = trim($this->data['UserProfile']['school_city_name']);
            $id               = $this->SchoolCity->findByName($school_city_name);
            if (!$id['SchoolCity']['id'])
            {
                $this->SchoolCity->create();
                $this->SchoolCity->save(array('name'       => $school_city_name, 'sorting'    => 0, 'notchecked' => 1));
                $id['SchoolCity']['id']                      = $this->SchoolCity->id;
            }
            $this->data['UserProfile']['school_city_id'] = $id['SchoolCity']['id'];
            unset($this->data['UserProfile']['school_city_name']);
        }

        /*
          Wenn die Berufsschule nicht in der Liste ist, fügen wir die manuell gesetzte hinzu. Vorher wird aber gecheckt,
          ob die manuell eingegebene Schule nicht doch dabei ist.
         */
        if (isset($this->data['UserProfile']['school_id']) && $this->data['UserProfile']['school_id'] == 354 && !empty($this->data['UserProfile']['school_name']))
        {
            $school_name = trim($this->data['UserProfile']['school_name']);
            $id          = $this->School->findByName($school_name);
            if (!$id['School']['id'])
            {
                $this->School->create();
                $this->School->save(array('name'           => $school_name, 'school_city_id' => $this->data['UserProfile']['school_city_id'], 'sorting'        => 0, 'notchecked'     => 1));
                $id['School']['id']                     = $this->School->id;
            }
            $this->data['UserProfile']['school_id'] = $id['School']['id'];
            unset($this->data['UserProfile']['school_name']);
        }

        return true;
    }


}
