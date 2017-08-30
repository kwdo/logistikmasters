<?php

class UserYear extends AppModel
{
    public $useTable = 'users_years'; // This model uses a database table 'exmp'
    public $actsAs = array('Utils.SoftDelete');


}