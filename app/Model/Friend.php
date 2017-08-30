<?php
App::uses('AppModel', 'Model');

class Friend extends AppModel {

    public $useTable = false;

    public $validate = array(
        'email' => array(
            'rule' => 'email',
            'required' => true,
            'message' => 'Bitte geben Sie eine richtige E-Mail ein'
        ),
        'message' => array(
            'rule' => 'notEmpty',
            'message' => 'Bitte geben Sie eine Text ein.'
        )
    );
}