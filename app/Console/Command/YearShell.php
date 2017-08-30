<?php
class YearShell extends AppShell
{
    public $uses = array('User','UserProfile','Year');
    public function main()
    {
        App::import('Component','Auth');
        $this->User->contain(array('Year'));
        $users = $this->User->find('all',array('conditions'=>array('User.role'=>'admin')));

        foreach($users as $user){
            $years = array();
            $fieldlist = array('User' => array('doubleoptin_hash', 'doubleoptin'));

            foreach($user['Year'] as $year){
                $years[] = $year["id"];
            }
            $years = array(1,2);
            $user['Year'] = $years;
            $fieldlist = array('Year');
            $this->User->id = $user['User']['id'];
            $this->User->save($user, array('validate' => false,'fieldList'=>$fieldlist));

            /*
            $this->User->id = $user['User']['id'];
            $this->User->save($user, array('validate' => false,'fieldList'=>$fieldlist));
            */
            //$this->out($user['User']['id']);
        }

        $this->out('Done.');
    }

}

?>