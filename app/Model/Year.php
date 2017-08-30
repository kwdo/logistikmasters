<?php
App::uses('AppModel', 'Model');
/**
 * Year Model
 *
 * @property User $User
 */
class Year extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'title';


    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasAndBelongsToMany associations
     *
     * @var array
     */
    public $hasAndBelongsToMany = array(
        'User' => array(
            'className' => 'User',
            'joinTable' => 'users_years',
            'foreignKey' => 'year_id',
            'associationForeignKey' => 'user_id',
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

    public function initYear(){
        set_time_limit ( 300 );
        $userfiles = $this->query("SELECT id,fileupload,fileupload_dir FROM user_profiles WHERE fileupload IS NOT NULL OR fileupload != ''");
        foreach($userfiles as $userfile){
            if(empty($userfile['user_profiles']['fileupload_dir'])){
                $userfile['user_profiles']['fileupload_dir'] = $userfile['user_profiles']['id'];
            }
            $file = WWW_ROOT. 'files/user_profile/fileupload/' . $userfile['user_profiles']['fileupload_dir'] . '/' . $userfile['user_profiles']['fileupload'];
            if(is_file($file) && (strpos($file,'.pdf') !== false || strpos($file,'.doc') !== false || strpos($file,'.jpg') !== false || strpos($file,'.png') !== false)){
                unlink($file);
            }
        }
        $updateFilesQuery = $this->query("UPDATE user_profiles SET fileupload=NULL,certificate=0");
        $updateUsersQuery = $this->query("UPDATE users SET doubleoptin=0 WHERE role!='admin'");
        $updateSchoolsQuery = $this->query("UPDATE schools SET user_profile_count=0");

        $adminUsers = $this->query("SELECT id FROM users WHERE role='admin'");

        /* Get last year */
        $year = $this->find('first',array('order' => array('title DESC'),));
        if(!empty($year['Year']['id'])){
            $yearId = $year['Year']['id'];
            foreach($adminUsers as $user){
                $userId = $user['users']['id'];
                $userQuery = $this->query("REPLACE INTO users_years (user_id,year_id) VALUES ($userId, $yearId)");
            }
        }
    }


    public function afterSave($created,$options=array()) {
        if($created){
            $this->initYear();
        }
        return true;
    }

}
