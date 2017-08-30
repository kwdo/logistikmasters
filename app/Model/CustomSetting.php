<?php
App::uses('AppModel', 'Model');

class CustomSetting extends AppModel {
    public $useTable = false; // This model does not use a database table
}
