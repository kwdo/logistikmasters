<?php
class CountschoolsShell extends AppShell
{
    public $uses = array('School','User');
    public function main()
    {
        App::import('Component','Auth');
        $this->User->unbindModel(
            array('hasOne' => array('UserCatalog','UserPoint')), false
        );
        $schools = $this->School->find('all');
        foreach($schools as $school){
            $usersCount = $this->User->find('count', array(
                'conditions' => array(
                    'UserProfile.school_id' => $school['School']['id'],
                    'User.doubleoptin' => 1
                )
            ));

            $fieldlist = array('School' => array('user_profile_count'));


            $school['School']['user_profile_count'] = $usersCount;
            $this->out($school['School']['id'] . ' - ' . $usersCount);
            $this->School->id = $school['School']['id'];
            $this->School->save($school, array('validate' => false,'fieldList'=>$fieldlist));

        }

        $this->out('Done.');
    }

}
?>