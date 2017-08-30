<?php

class UserCatalog extends AppModel
{
    public $actsAs = array('Utils.SoftDelete');

    public $hasOne = array(
		'User' => array(
			'foreignKey' => 'userID'
		)
	);

}

