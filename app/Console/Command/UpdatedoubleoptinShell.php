<?php
class UpdatedoubleoptinShell extends AppShell
{
    public $uses = array('User');
    public function main()
    {
        App::import('Component','Auth');
        $this->User->contain();
        $users = $this->User->find('all', array('conditions' => array('doubleoptin' => 0)));
        foreach($users as $user){
            $user['User']['doubleoptin_hash'] = sha1(serialize($user['User']) . time(true));
            $user['User']['doubleoptin'] = 0;
            $fieldlist = array('User' => array('doubleoptin_hash', 'doubleoptin'));
            $this->User->id = $user['User']['id'];
            $this->User->save($user, array('validate' => false,'fieldList'=>$fieldlist));
            $this->out($user['User']['doubleoptin_hash']);
        }

        $this->out('Done.');
    }

}

?>