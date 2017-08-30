<?php

    App::uses('AppController', 'Controller');
    App::uses('Sanitize', 'Utility');
    App::uses('CakeTime', 'Utility');
    define('LABEL_TRAINER_FIRSTNAME', 'Vorname Professor / Studienleiter');
    define('LABEL_TRAINER_SURNAME', 'Nachname Professor / Studienleiter');

    /**
     * Users Controller
     *
     * @property User $User
     */
    class UsersController extends AppController
    {

        public $helpers = array(
            'Js',
            'Time',
            'Csv',
            'Text',
            'Html',
            'Captcha'
        );
        public $currentYear = null;
        public $year = null;

        /**
         * add method
         *
         * @return void
         */
        public function add()
        {

            $configCustom = Configure::read('custom_settings');

            // Closed?
            if (time() > $configCustom['competion_end']) {
                $this->Session->setFlash('Der aktuelle Wettbewerb wurde beendet. Die Registrierung für den kommenden Wettbewerb beginnt am ' . date("d.m.Y",$configCustom['next_competition']). '.');
                $this->redirect(array('controller' => 'forms', 'action' => 'index'));
            }


            if ($this->request->is('post'))
            {
                $this->request->data['Year'] = array(CURRENT_YEAR_ID);
                $this->User->create();
                $this->request->data['User']['doubleoptin_hash'] = sha1(serialize($this->request->data['User']) . time(true));
                if ($this->User->saveAll($this->request->data))
                {
                    $text = $configCustom['reactivate_email_text'];
                    $searchArray = array('<a','<p','<li','<ul','<ol');
                    $replaceArray = array('<a style="font: bold 14px Arial;color: #000000; text-decoration: underline;"','<p style="font: 14px Arial; padding: 0; margin: 0 0 20px 0;"','<li style="font: 14px Arial; margin: 0 0 5px 0;"','<ul style="margin-bottom: 20px; list-style: square;"','<ol style="margin-bottom: 20px;"');
                    $text = str_replace($searchArray,$replaceArray,$text);

                    App::uses('CakeEmail', 'Network/Email');
                    $mail = new CakeEmail();
                    $mail->from('logistikmasters@springer.com')
                            ->to($this->request->data['User']['email'])
                            ->subject('Bestätigen Sie Ihre Teilnahme bei Logistik Masters')
                            ->emailFormat('html')
                            ->template('activation')
                            ->viewVars(array(   'firstname' => $this->request->data['UserProfile']['firstname'],
                                'surname' => $this->request->data['UserProfile']['surname'],
                                'text' => $text,
                                'activationLink' => 'https://' . $_SERVER['HTTP_HOST'] . '/users/doubleoptin/' . $this->request->data['User']['doubleoptin_hash']))
                            ->send();
                    $this->User->Profile->getUserProfile($this->User->id);
                    $this->redirect(array('action' => 'registered'));
                }
                else
                {
                    $this->Session->setFlash('Bitte überprüfe Deine Eingaben');
                }
            }
            $schoolCities = $this->User->UserProfile->SchoolCity->find('list');
            $schools      = $this->User->UserProfile->School->find('list');
            $this->set(compact('schools', 'schoolCities'));
        }

        /**
         * add method
         *
         * @return void
         */
        public function admin_add()
        {
            if ($this->request->is('post'))
            {
                $this->User->create();
                $this->request->data['User']['doubleoptin_hash'] = sha1(serialize($this->request->data['User']) . time(true));
                $this->request->data['Year']                     = array(CURRENT_YEAR_ID);
                if ($this->User->saveAll($this->request->data))
                {
                    App::uses('CakeEmail', 'Network/Email');
                    $mail = new CakeEmail();
                    $mail->from('logistikmasters@springer.com')
                        ->to($this->request->data['User']['email'])
                        ->subject('DoubleOptIn von Logistik Masters')
                        ->send('Hallo ' . $this->request->data['UserProfile']['firstname'] . ' ' . $this->request->data['UserProfile']['surname'] . ',' . PHP_EOL . PHP_EOL .
                            'um am Wettbewerb teilzunehmen, musst Du Deinen Account über folgenden Link aktivieren: ' . PHP_EOL .
                            'https://' . $_SERVER['HTTP_HOST'] . '/users/doubleoptin/' . $this->request->data['User']['doubleoptin_hash'] . PHP_EOL . PHP_EOL . 'Dein Logistik Masters Team');

                    $this->Session->setFlash(__('The user has been saved'));
                    $this->redirect(array('action' => 'registered'));
                }
                else
                {
                    $this->Session->setFlash('Bitte überprüfe Deine Eingaben');
                }
            }
            $forms        = $this->User->Form->find('list');
            $questions    = $this->User->Question->find('list');
            $schoolCities = $this->User->UserProfile->SchoolCity->find('list');
            $schools      = $this->User->UserProfile->School->find('list');
            $this->set(compact('schools', 'schoolCities'));
        }


       /**
         * doubleoptin after register, Updates the notify_on_activity field
         *
         * @param $key      find user by given key
         * @return void
         */
        public function doubleoptin_rsnd($id = null)
        {


            if ($id == null)
            {
                $this->Session->setFlash('Der Benutzer konnte nicht gefunden werden');
                $this->redirect(array('action' => 'index'));
                return;
            }
            $user = $this->User->find('first', array(
                'conditions' => array(
                    'User.id'     => $id,
                    'doubleoptin' => 0
                )
            ));

            if ($user)
            {
                if ($this->request->is('post'))
                {
                    $user['User']['doubleoptin_hash'] = sha1(serialize($user['User']) . time(true));
                    $fieldlist                        = array('User' => array('doubleoptin_hash'));
                    $this->User->id                   = $user['User']['id'];
                    if ($this->User->save($user, array(
                        'validate'  => false,
                        'fieldList' => $fieldlist
                    ))
                    )

                    {
                        $config = Configure::read('custom_settings');
                        $text = $config['reactivate_email_text'];
                        $searchArray = array('<a','<p','<li','<ul','<ol');
                        $replaceArray = array('<a style="font: bold 14px Arial;color: #000000; text-decoration: underline;"','<p style="font: 14px Arial; padding: 0; margin: 0 0 20px 0;"','<li style="font: 14px Arial; margin: 0 0 5px 0;"','<ul style="margin-bottom: 20px; list-style: square;"','<ol style="margin-bottom: 20px;"');
                        $text = str_replace($searchArray,$replaceArray,$text);

                        App::uses('CakeEmail', 'Network/Email');
                        $mail = new CakeEmail();
                        $mail->from('logistikmasters@springer.com')
                            ->to($user['User']['email'])
                            ->subject('Bestätigen Sie Ihre Teilnahme bei Logistik Masters')
                            ->emailFormat('html')
                            ->template('activation')
                            ->viewVars(array(   'firstname' => $user['UserProfile']['firstname'],
                                'surname' => $user['UserProfile']['surname'],
                                'text' => $text,
                                'activationLink' => 'https://' . $_SERVER['HTTP_HOST'] . '/users/doubleoptin/' . $user['User']['doubleoptin_hash']))
                            ->send();
                        $this->Session->setFlash('Der Aktivierungslink wurde erfolgreich versendet.');
                        $this->redirect(array(
                            'controller' => 'pages',
                            'action'     => 'display'
                        ));
                    }
                    else
                    {
                        $this->Session->setFlash('Es ist ein Fehler aufgetreten.');
                        $this->redirect(array(
                            'controller' => 'pages',
                            'action'     => 'display'
                        ));
                    }
                }
                else
                {

                    /*
                    $fieldlist = array('User' => array('doubleoptin_hash', 'doubleoptin'),'Year');
                    $this->User->id = $user['User']['id'];
                    $this->User->save($user, array('validate' => false,'fieldList'=>$fieldlist));
                    */
                    $this->set('user', $user);
                }
            }
            else
            {
                $this->Session->setFlash('Du bist bereits zurückgemeldet.');
                $this->redirect(array(
                    'controller' => 'forms',
                    'action'     => 'index'
                ));
            }
        }



        /**
         * doubleoptin after register, Updates the notify_on_activity field
         *
         * @param $key      find user by given key
         * @return void
         */
        public function doubleoptin($key = null)
        {

            if ($key == null) {
                $this->Session->setFlash('Der Benutzer konnte nicht gefunden werden');
                $this->redirect(array('action' => 'add'));
                return;
            }

            $user = $this->User->find('first', array('conditions' => array('doubleoptin_hash' => $key, 'doubleoptin' => 0)));

            if ($user) {
                //check if degree is allready filled
                if(empty($user['UserProfile']['degree'])){
                    $this->redirect(array(
                        'action'     => 'complete_profile',
                        $key
                    ));
                }

                $years = array();

                foreach ($user['Year'] as $year) {
                    $years[] = $year["id"];
                }

                if (!in_array(CURRENT_YEAR_ID, $years)) {
                    $years[] = CURRENT_YEAR_ID;
                }

                $user['Year']                     = $years;
                $user['User']['doubleoptin_hash'] = '';
                $user['User']['doubleoptin']      = '1';

                $fieldlist         = array('User' => array('doubleoptin_hash', 'doubleoptin'), 'Year');

                $this->User->id                   = $user['User']['id'];
                $this->User->save($user, array('validate' => false, 'fieldList' => $fieldlist));
                $this->User->UserProfile->id                   = $user['UserProfile']['id'];
                $this->User->UserProfile->save($user['UserProfile'], array('validate' => false));

                $this->Session->setFlash('Dein Account wurde aktiviert. Viel Spaß beim Wettbewerb.<br>Bitte überprüfe deine Daten und aktualisiere sie gegebenenfalls.', 'default', array('class' => 'success'));
            }
            else {
               $this->Session->setFlash('Der Benutzer konnte nicht gefunden werden');
                $this->redirect(array('action' => 'login', 'controller' => 'users'));
            }
            $this->redirect(array('controller' => 'forms', 'action' => 'index'));;
        }


        /**
         * complete profile before completing doubleoptin process
         *
         * @param $key      find user by given key
         * @return void
         */
        public function complete_profile($key = null)
        {

            if ($key == null) {
                $this->Session->setFlash('Der Benutzer konnte nicht gefunden werden');
                $this->redirect(array('action' => 'add'));
                return;
            }

            $user = $this->User->find('first', array('conditions' => array('doubleoptin_hash' => $key, 'doubleoptin' => 0)));

            if ($user) {
                //check if degree is allready filled
                if(!empty($user['UserProfile']['degree'])){
                    $this->redirect(array(
                        'action'     => 'doubleoptin',
                        $key
                    ));
                }

                if ($this->request->is('post') || $this->request->is('put')) {
                    $fieldList = array(
                        'UserProfile' => array(
                            'degree',
                            'degree_name'
                        )
                    );

                    $this->request->data['User']['id'] = $user['User']['id'];
                    $this->request->data['UserProfile']['id'] = $user['UserProfile']['id'];

                    if ($this->User->saveAll(
                        $this->request->data, array('validate' => 'only','fieldList' => $fieldList)
                    )) {
                        $years = array();

                        foreach ($user['Year'] as $year) {
                            $years[] = $year["id"];
                        }

                        if (!in_array(CURRENT_YEAR_ID, $years)) {
                            $years[] = CURRENT_YEAR_ID;
                        }

                        $user['Year']                     = $years;
                        $user['User']['doubleoptin_hash'] = '';
                        $user['User']['doubleoptin']      = '1';

                        $fieldlist         = array('User' => array('doubleoptin_hash', 'doubleoptin'), 'Year');

                        $this->User->id                   = $user['User']['id'];
                        $this->User->save($user, array('validate' => false, 'fieldList' => $fieldlist));

                        $user['UserProfile']['degree'] = $this->request->data['UserProfile']['degree'];
                        $user['UserProfile']['degree_name'] =$this->request->data['UserProfile']['degree_name'];

                        $this->User->UserProfile->id                   = $user['UserProfile']['id'];
                        $this->User->UserProfile->save($user['UserProfile'], array('validate' => false));

                        $this->Session->setFlash('Ihr Account wurde aktiviert. Viel Spaß beim Wettbewerb. <br />Bitte überprüfen Sie Ihre Daten und aktualisieren sie gegebenenfalls', 'default', array('class' => 'success'));
                        $this->redirect('/');
                    }
                }
            }
            else {
                $this->Session->setFlash('Der Benutzer konnte nicht gefunden werden');
                $this->redirect(array('action' => 'login', 'controller' => 'users'));
            }
        }


        /**
         * edit method
         *
         * @throws NotFoundException
         * @param string $id
         * @return void
         */
        public function edit()
        {
            $this->User->id = $this->Auth->user('id');
            if (!$this->User->exists())
            {
                throw new NotFoundException(__('Invalid user'));
            }
            if ($this->request->is('post') || $this->request->is('put'))
            {
                $fieldList = array(
                    'User'        => array(
                        'username',
                        'email'
                    ),
                    'UserProfile' => array(
                        'gender',
                        'firstname',
                        'surname',
                        'street',
                        'zip',
                        'city',
                        'phone',
                        'nationality',
                        'birthdate',
                        'birthland',
                        'school_city_id',
                        'school_id',
                        'school_city_name',
                        'school_name',
                        'company',
                        'trainer_firstname',
                        'trainer_surname',
                        'company_city',
                        'graduation',
                        'begineducation',
                        'endeducation',
                        'themeofdissertation',
                        'abschlussnote',
                        'einsatztermin',
                        'einsatzort',
                        'beschaeftigungsart',
                        'karrierestatus',
                        'unternehmenp1',
                        'beginnp1',
                        'endep1',
                        'taetigkeitp1',
                        'unternehmenp2',
                        'beginnp2',
                        'endep2',
                        'taetigkeitp2',
                        'unternehmenp3',
                        'beginnp3',
                        'endep3',
                        'taetigkeitp3',
                        'sprache1',
                        'sprache1kenntnisse',
                        'sprache2',
                        'sprache2kenntnisse',
                        'sprache3',
                        'sprache3kenntnisse',
                        'sprache4',
                        'sprache4kenntnisse',
                        'sprache5',
                        'sprache5kenntnisse',
                        'sonstigekenntnisse',
                        'school2_city',
                        'school2_name',
                        'school2_company',
                        'school2_trainer_firstname',
                        'school2_trainer_surname',
                        'school2_company_city',
                        'school2_graduation',
                        'school2_begineducation',
                        'school2_endeducation',
                        'school2_themeofdissertation',
                        'school2_abschlussnote',
                        'degree',
                        'degree_name'
                    )
                );

                $this->request->data['user']['id'] = $this->User->id;
                if ($this->User->saveAssociated($this->request->data, array('fieldList' => $fieldList)))
                {

                    $this->Session->setFlash(__('Dein Profil wurde gespeichert'));
                    $this->redirect(array(
                        'controller' => 'forms',
                        'action'     => 'index'
                    ));
                }
                else
                {
                    $this->Session->setFlash(__('Ihr Profil konnte nicht gespeichert werden. Bitte versuchen Sie es erneut.'));
                }
            }
            else
            {
                $this->request->data = $this->User->read(null, $this->User->id);
            }
            $schoolCities = $this->User->UserProfile->SchoolCity->find('list');
            $schools      = $this->User->UserProfile->School->find('list');
            $this->set(compact('schools', 'schoolCities', 'degree', 'degree_name'));
            $this->set('user', $this->User->data);
            //debug($this->User->data);
        }

        /**
         * edit password method
         *
         * @return void
         */
        public function edit_password()
        {
            $this->User->id = $this->Auth->user('id');
            if (!$this->User->exists()) {
                throw new NotFoundException(__('Invalid user'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                $this->User->id = $user['User']['id'];
                $fieldList = array('User'=>array('password'));

                if ($this->User->saveAll($this->request->data, array('validate' => true,'fieldList'=>$fieldList))) {
                    $this->Session->setFlash(__('Dein Passwort wurde geändert'));
                    $this->redirect(array('controller' => 'forms', 'action' => 'index'));
                } else {
                    $this->Session->setFlash(__('Dein Passwort konnte nicht geändert werden. Bitte versuche es erneut.'));
                }
            } else {
                $this->request->data = $this->User->read(null, $this->User->id);
            }
        }

        /**
         * edit upload
         *
         * @throws NotFoundException
         * @param string $id
         * @return void
         */
        public function edit_upload()
        {
            $this->User->id = $this->Auth->user('id');
            if (!$this->User->exists())
            {
                throw new NotFoundException(__('Invalid user'));
            }
            if ($this->request->is('post') || $this->request->is('put'))
            {
                if ($this->User->saveAssociated($this->request->data, array(
                    'validate'  => false,
                    'fieldList' => array(
                        'UserProfile' => array(
                            'fileupload',
                            'fileupload_dir'
                        )
                    )
                ))
                )
                {
                    $this->Session->setFlash(__('Die Immatrikulationsbescheinigung wurde hochgeladen'));
                    //$this->redirect(array('controller'=>'forms','action' => 'index'));
                }
                else
                {
                    $this->Session->setFlash(__('Ihr Profil konnte nicht gespeichert werden. Bitte versuchen Sie es erneut.'));
                }
            }
            else
            {
                $this->request->data = $this->User->read(null, $this->User->id);
            }
            $user = $this->User->read(null, $this->User->id);
            $this->set(compact('user'));
        }

        /**
         * edit upload
         *
         * @throws NotFoundException
         * @param string $id
         * @return void
         */
        public function edit_pic_upload()
        {
            $this->User->id = $this->Auth->user('id');
            if (!$this->User->exists())
            {
                throw new NotFoundException(__('Invalid user'));
            }
            if ($this->request->is('post') || $this->request->is('put'))
            {
                if ($this->User->saveAssociated($this->request->data, array(
                    'validate'  => false,
                    'fieldList' => array(
                        'UserProfile' => array(
                            'picupload',
                            'picupload_dir'
                        )
                    )
                ))
                )
                {
                    $this->Session->setFlash(__('Ihr Portrait wurde hochgeladen'));
                    //$this->redirect(array('controller'=>'forms','action' => 'index'));
                }
                else
                {
                    $this->Session->setFlash(__('Ihr Profil konnte nicht gespeichert werden. Bitte versuchen Sie es erneut.'));
                }
            }
            else
            {
                $this->request->data = $this->User->read(null, $this->User->id);
            }
            $user = $this->User->read(null, $this->User->id);
            $this->set(compact('user'));
        }

        /**
         * method to request a new password
         *
         * @return void
         */
        public function pwlost()
        {
            App::uses('CakeEmail', 'Network/Email');

            if ($this->Auth->loggedIn())
            {
                return $this->redirect(array(
                    'action' => 'view',
                    $this->Auth->user('id')
                ));
            }

            if ($this->request->is('post') && !empty($this->data['User']['email']))
            {
                echo $this->data['User']['email'];
                $cond['email'] = $this->data['User']['email'];

                $this->User->recursive = -1;
                $user                  = $this->User->find('first', array(
                    'conditions' => $cond,
                    'fields'     => array(
                        'id',
                        'username',
                        'email'
                    )
                ));


                if ($user['User']['email'])
                {
                    $key  = sha1(serialize($user) . time(true));
                    $mail = new CakeEmail();
                    $mail->from('logistikmasters@springer.com')
                        ->to($user['User']['email'])
                        ->subject('Passwort vergessen auf Logistik Masters')
                        ->send('Hallo ' . $user['User']['username'] . ',' . PHP_EOL . PHP_EOL .
                            'um ein neues Passwort zu erhalten klicke  bitte auf den folgenden Link: ' . PHP_EOL .
                            'https://' . $_SERVER['HTTP_HOST'] . '/users/newpw/' . $key . PHP_EOL . PHP_EOL . 'Dein Logistik Masters Team');

                    $user['User']['pw_lost'] = $key;
                    $fieldList             = array('User' => array('pw_lost'));
                    $this->User->id        = $user['User']['id'];
                    $this->User->save($user, array('validate' => false, 'fieldList' => $fieldList));

                    $this->Session->setFlash('Eine E-Mail mit weiteren Anweisungen wurde versendet', 'default', array('class' => 'success'));
                    $this->redirect($this->Auth->logout('/questions/index'));
                }
                else
                {
                    $this->Session->setFlash('Der Benutzer konnte nicht gefunden werden');
                }
            }
        }

        /**
         * method to generate a new password
         *
         * @param $key      find user by given key
         * @return void
         */
        public function newpw($key = null)
        {
            App::uses('CakeEmail', 'Network/Email');

            if ($key == null)
            {
                $this->Session->setFlash('Der Benutzer konnte nicht gefunden werden');
                $this->redirect($this->Auth->logout('/forms/index'));
                return;
            }

            $this->User->recursive = -1;
            $user                  = $this->User->find('first', array(
                'conditions' => array('pw_lost' => $key),
                'fields'     => array(
                    'id',
                    'username',
                    'email'
                )
            ));

            if ($user)
            {
                $pass = substr(sha1(rand()), 0, 6);

                $mail = new CakeEmail();
                $mail->from('logistikmasters@springer.com')
                    ->to($user['User']['email'])
                    ->subject('Neues Passwort für Logistik Masters')
                    ->send('Hallo ' . $user['User']['username'] . ',' . PHP_EOL . PHP_EOL .
                        'Dein neues Passwort lautet: ' . $pass . PHP_EOL . PHP_EOL . 'Dein Logistik Masters Team');

                $user['User']['pw_lost']  = '';
                $user['User']['password'] = $pass;
                $fieldList                = array(
                    'User' => array(
                        'pw_lost',
                        'password'
                    )
                );
                $this->User->id           = $user['User']['id'];
                $this->User->save($user, array(
                    'validate'  => false,
                    'fieldList' => $fieldList
                ));

                $this->Session->setFlash('Ein neues Passwort wurde gesetzt und per E-Mail gesendet', 'default', array('class' => 'success'));
            }
            else
            {
                $this->Session->setFlash('Der Benutzer konnte nicht gefunden werden');
            }
            $this->redirect($this->Auth->logout('/forms/index'));
        }

        /**
         * admin_edit method
         *
         * @throws NotFoundException
         * @param string $id
         * @return void
         */
        public function admin_edit($id = null)
        {
            $this->User->id = $id;
            if (!$this->User->exists())
            {
                throw new NotFoundException(__('Invalid user'));
            }

            $user = $this->User->read(null, $this->User->id);
            if ($this->request->is('post') || $this->request->is('put'))
            {
                $years = array();

                foreach ($user['Year'] as $year)
                {
                    $years[] = $year["id"];
                }

                if (!in_array(CURRENT_YEAR_ID, $years))
                {
                    $years[] = CURRENT_YEAR_ID;
                }

                $this->request->data['Year'] = $years;

                if ($this->User->saveAssociated($this->request->data))
                {
                    $this->Session->setFlash(__('Das Profil wurde gespeichert'));
                    $redirectArray = array('action' => 'index');
                    foreach ($this->request->params['named'] as $key => $value)
                    {
                        $redirectArray[$key] = $value;
                    }
                    $this->redirect($redirectArray);
                }
                else
                {
                    $this->Session->setFlash(__('Das Profil konnte nicht gespeichert werden. Bitte versuchen Sie es erneut.'));
                }
            }
            else
            {
                $this->request->data = $user;
            }
            $schoolCities = $this->User->UserProfile->SchoolCity->find('list');
            $schools      = $this->User->UserProfile->School->find('list');
            $this->set(compact('schools', 'schoolCities'));
        }

        /**
         * delete method
         *
         * @throws MethodNotAllowedException
         * @throws NotFoundException
         * @param string $id
         * @return void
         */
        public function admin_delete($id = null)
        {
            if (!$this->request->is('post')) {
                throw new MethodNotAllowedException();
            }
            $this->User->id = $id;
            if (!$this->User->exists()) {
                throw new NotFoundException(__('Unbekannter Benutzer'));
            }

            if ($this->User->delete()) {
                $this->Session->setFlash(__('Der Benutzer wurde gelöscht'));
            }else{
                $this->Session->setFlash(__('Der Benutzer wurde nicht gelöscht'));
            }
            $url = $this->Session->read('LastUrl') ? $this->Session->read('LastUrl') :  array('action' => 'index');
            $this->redirect($url);
        }


        /**
         * delete method
         *
         * @throws MethodNotAllowedException
         * @throws NotFoundException
         * @param string $id
         * @return void
         */
        public function admin_undelete($id = null)
        {
            $this->User->id = $id;
            if ($this->User->undelete($id)) {
                $this->Session->setFlash(__('Der Benutzer wurde erfolgreich wieder hergestellt'));
                $this->redirect(array('action' => 'index_deleted'));
            }
            $this->Session->setFlash(__('Der Benutzer wurde nicht wiederhergestellt'));
            $this->redirect(array('action' => 'index_deleted'));
        }

        function admin_mass_delete()
        {
            if (!$this->request->is('post')) {
                throw new MethodNotAllowedException();
            }

            $ids = $this->request['data']['User']['id'];

            if (!$ids) {
                $this->Session->setFlash('Ungültiger Benutzer');
                $this->redirect(array('action' => 'index'));
            }

            if (!is_array($ids)) {
                $ids = array($ids);
            }

            foreach ($ids as $id) {
                $this->User->id = $id;
                $this->User->delete();
            }

            $this->Session->setFlash('Die User wurden gelöscht');
            $url = $this->Session->read('LastUrl') ? $this->Session->read('LastUrl') :  array('action' => 'index');
            $this->redirect($url);
        }

        public function login()
        {
            if ($this->request->is('post'))
            {
                //$this->Session->destroy();
                if (!empty($this->request->data['User']['email']))
                {
                    $this->User->recursive = -1;
                    $userTmp               = $this->User->find('first', array(
                        'fields'     => array(
                            'User.id',
                            'User.doubleoptin'
                        ),
                        'conditions' => array('User.email' => $this->request->data['User']['email'])
                    ));
                    if (!$userTmp['User']['doubleoptin'])
                    {
                        $this->redirect(array(
                            'action' => 'doubleoptin_rsnd',
                            $userTmp['User']['id']
                        ));
                    }
                }

                if ($this->Auth->login())
                {
                    $user = $this->Auth->user();
                    $this->User->Profile->login($user['id']);
                    $this->User->read(null, $user['id']);
                    $this->User->saveField('lastlogin', date('Y-m-d H:i:s'));
                    $this->Session->delete('Forum');
                    $this->_setCookie($this->Auth->user('id'));

                    if ($this->referer() && $this->referer() != 'https://'. $_SERVER['HTTP_HOST'] . '/users/login')
                    {
                        $this->redirect($this->referer());
                    }
                    else
                    {
                        $this->redirect($this->Auth->redirect());
                    }

                }
                else
                {
                    $this->Session->setFlash(__('Unbekannter Username oder falsches Passwort. Bitte versuche es erneut.'));
                }
            }elseif ($this->Auth->loggedIn() || $this->Auth->login()) {
                $user = $this->Auth->user();
                $this->User->Profile->login($user['id']);
                $this->Session->delete('Forum');
                $this->_setCookie($this->Auth->user('id'));

                if ($this->referer() && $this->referer() != 'https://' . $_SERVER['HTTP_HOST'] . '/users/login')
                {
                    $this->redirect($this->referer());
                }
                else
                {
                    $this->redirect($this->Auth->redirect());
                }

            }else{
                $this->Cookie->destroy();
            }
        }

        protected function _setCookie($id) {
            if (!$this->request->data('User.remember_me')) {
                return false;
            }
            $data = array(
                'username' => $this->request->data('User.username'),
                'password' => $this->request->data('User.password')
            );
            $this->Cookie->write('User', $data, true, '+4 weeks');
            return true;
        }

        public function admin_login()
        {
            if ($this->request->is('post'))
            {
                if ($this->Auth->login())
                {
                    $user = $this->Auth->user();
                    $this->User->Profile->login($user['id']);
                    $this->Session->delete('Forum');

                    if ($this->referer())
                    {
                        $this->redirect($this->referer());
                    }
                    else
                    {
                        $this->redirect($this->Auth->redirect());
                    }

                }
                else
                {
                    $this->Session->setFlash(__('Unbekannter Username oder falsches Passwort. Bitte versuche es erneut.'));
                }
            }
        }

        public function logout()
        {
            $this->Session->delete('Forum');
            $this->redirect($this->Auth->logout());
        }

        /**
         * registered method
         *
         * @return void
         */
        public function registered()
        {

        }

        /**
         * admin_index method
         *
         * @return void
         */
        public function admin_index($year_id = null)
        {
            $this->Session->write('LastUrl', Router::url(null, true));

            if ($year_id)
            {
                $year_id = (int)$year_id;
            }
            elseif (!empty($this->params['named']['year_id']))
            {
                $year_id = (int)$this->params['named']['year_id'];
            }
            elseif (!empty($this->request->data['User']['year_id']))
            {
                $year_id = (int)$this->request->data['User']['year_id'];
            }
            else
            {
                $year_id = CURRENT_YEAR_ID;
            }


            $conditions = array(
                'UsersYears.year_id' => $year_id
            );

            $this->User->unbindModel(
                array(
                    'hasOne'  => array('UserCatalog'),
                    'hasMany' => array('UserPoint')
                ), false
            );

            $this->User->bindModel(array('hasOne' => array('UserPoint')), false);


            $contain = array(
                'UserProfile',
                'UserPoint' => array(
                    'conditions' => array(
                        'UserPoint.year' => $year_id + 12
                    )
                ),
                'UsersYears'
            );


            if (!empty($this->request->data))
            {
                $conditions['UserProfile.surname LIKE'] = '%' . $this->request->data['UserProfile']['surname'] . '%';
            }

            if (!empty($this->request->data['UserProfile']['school_id']))
            {
                $conditions['UserProfile.school_id'] = $this->request->data['UserProfile']['school_id'];
            }

            $editArray      = array('action' => 'edit');
            $deleteAllArray = array('action' => 'mass_delete');
            foreach ($this->request->params['named'] as $key => $value)
            {
                $editArray[$key]      = $value;
                $deleteAllArray[$key] = $value;
            }

            $this->User->bindModel(array('hasOne' => array('UsersYears')), false);

            $this->paginate = array(
                'limit'   => 25,
                'order'   => array(
                    'UserProfile.surname'   => 'asc',
                    'UserProfile.firstname' => 'asc',
                ),
                'contain' => $contain
            );
            $users          = $this->paginate($conditions);
            $schoolsRaw     = $this->User->UserProfile->School->find('all', array(
                'sort'  => 'asc',
                'order' => 'School.name'
            ));
            $schools        = array();
            foreach ($schoolsRaw as $key => $value)
            {
                $schools[$value['School']['id']] = $value['School']['name'] . ' (' . $value['SchoolCity']['name'] . ' )';
            }
            $this->set('deleteAllArray', $deleteAllArray);
            $this->set('editArray', $editArray);
            $this->set('schools', $schools);
            $this->set('year_id', $year_id);
            $this->set('users', $users);
        }

        /**
         * admin_index method
         *
         * @return void
         */
        public function admin_index_deleted($year_id = null)
        {

            if($year_id){
                $year_id = (int)$year_id;
            }elseif(!empty($this->params['named']['year_id'])) {
                $year_id = (int)$this->params['named']['year_id'];
            }elseif(!empty($this->request->data['User']['year_id'])) {
                $year_id = (int)$this->request->data['User']['year_id'];
            }  else {
                $year_id = CURRENT_YEAR_ID;
            }

            $this->User->softDelete(false);

            $this->User->unbindModel(
                array('hasOne' => array('UserCatalog'),'hasMany' => array('Year')), false
            );

            $conditions['User.deleted'] = 1;


            $contain = array(
                'UserProfile'
            );


            if (!empty($this->request->data)) {
                $conditions['UserProfile.surname LIKE'] = '%' . $this->request->data['UserProfile']['surname'] . '%';
            }



            $this->paginate = array(
                'limit' => 25,
                'order' => array(
                    'UserProfile.surname'   => 'asc',
                    'UserProfile.firstname' => 'asc',
                ),
                'contain' => $contain
            );
            $users = $this->paginate($conditions);
            $this->set('year_id', $year_id);
            $this->set('users', $users);
            $this->User->softDelete(true);
        }

        /**
         * admin_index method
         *
         * @return void
         */
        public function admin_duplicate_records($year_id = null)
        {
            $this->Session->write('LastUrl', Router::url(null, true));
            if ($year_id)
            {
                $year_id = (int)$year_id;
            }
            elseif (!empty($this->params['named']['year_id']))
            {
                $year_id = (int)$this->params['named']['year_id'];
            }
            elseif (!empty($this->request->data['User']['year_id']))
            {
                $year_id = (int)$this->request->data['User']['year_id'];
            }
            else
            {
                $year_id = CURRENT_YEAR_ID;
            }


            $duplicate_records = array();
            $results           = $this->User->query("SELECT COUNT(*), surname, firstname FROM user_profiles, users_years,users WHERE user_profiles.user_id=users_years.user_id AND users.id=user_profiles.user_id AND users.deleted=0 AND users_years.year_id=$year_id GROUP BY surname, firstname HAVING COUNT(*)>1");

            foreach ($results as $value)
            {
                if (!empty($value['user_profiles']['surname']))
                {
                    $user_results = $this->User->query("SELECT user_profiles.user_id FROM user_profiles , users_years, users  WHERE  user_profiles.user_id=users_years.user_id AND users.id=user_profiles.user_id AND users.deleted=0 AND users_years.year_id=$year_id AND surname='" . $value['user_profiles']['surname'] . "' AND firstname='" . $value['user_profiles']['firstname'] . "'");

                    foreach ($user_results as $u_val)
                    {
                        $duplicate_records[] = $u_val['user_profiles']['user_id'];
                    }
                }
            }


            $contain = array(
                'UserProfile',
                'UserPoint' => array(
                    'conditions' => array(
                        'UserPoint.year' => $year_id + 12
                    )
                )
            );


            if (!empty($this->request->data))
            {
                $conditions['UserProfile.surname LIKE'] = '%' . $this->request->data['UserProfile']['surname'] . '%';
            }
            $conditions['User.id'] = $duplicate_records;
            $editArray             = array('action' => 'edit');
            foreach ($this->request->params['named'] as $key => $value)
            {
                $editArray[$key] = $value;
            }

            $deleteAllArray = array('action' => 'mass_delete');
            foreach ($this->request->params['named'] as $key => $value) {
                $editArray[$key] = $value;
                $deleteAllArray[$key] = $value;
            }

            $this->paginate = array(
                'limit'   => 25,
                'order'   => array(
                    'UserProfile.surname'   => 'asc',
                    'UserProfile.firstname' => 'asc',
                ),
                'contain' => $contain
            );
            $this->set('editArray', $editArray);
            $this->set('deleteAllArray', $deleteAllArray);
            $this->set('year_id', $year_id);
            $this->set('users', $this->paginate($conditions));
        }

        public function admin_view($id = 0)
        {
            if (!$id)
            {
                $this->Session->setFlash('Ungültiger Aufruf');
                $this->redirect(array(
                    'controller' => 'users',
                    'action'     => 'index'
                ));
            }


            // insert stats row
            $this->User->UserPoint->initStatsRow($id);
            $this->User->recursive = 2;
            $this->User->contain(array(
                'UserProfile' => array(
                    'School',
                    'SchoolCity'
                ),

                'Form'        => array(
                    'conditions' => array(
                        'Form.year' => (CURRENT_YEAR - 2000)
                    )
                )
            ));
            $user = $this->User->read(null, $id);
            $this->set('user', $user);

            //PDF
            /*
              $params = array(
              'fields' => array('UserPdf.userpdfID'),
              'conditions' => array('UserPdf.userID' => $id)
              );
              $pdf = $this->UserPdf->find('all', $params);
              if (count($pdf)) {
              $this->set('pdf', $pdf);
              }
             */

            // forms
            $params                      = array(
                'fields'     => array(
                    'Form.id',
                    'Form.title'
                ),
                'conditions' => array('year' => CURRENT_YEAR - 2000)
            );
            $this->User->Form->recursive = -1;
            $forms                       = $this->User->Form->find('list', $params);

            foreach ($forms as $key => $value)
            {
                $forms[$key] = array('title' => $value);
            }
            foreach ($user['Form'] as $value)
            {
                $forms[$value['id']]['FormsUser'] = $value['FormsUser'];
            }
            $this->set('forms', $forms);
        }

        public function admin_calc_points()
        {
            $this->User->setPoints($this->params['named']['year']);
            $this->User->setStats($this->params['named']['year']);

            $this->Session->setFlash('Die Punkte wurden berechnet');
            $this->redirect("/admin/users/index/" . $this->params['named']['year_id']);
        }

        public function admin_report()
        {
            $this->layout = 'blank';
            $year_id      = CURRENT_YEAR_ID;
            Configure::write('debug', 0);
            set_time_limit(1800);
            $this->set('isLatin1', ($this->request->data['User']['output_charset'] == 'latin1'));

            $this->User->unbindModel(
                array('hasOne' => array('UserCatalog')), false
            );
            $mode       = (int)$this->request->data['User']['Auswerten'];
            $formscount = (int)$this->request->data['User']['formscount'];

            $this->User->Form->unbindModel(array(
                'hasMany' => array('Question')
            ));

            $params = array(
                'order'  => 'UserPoint.points DESC'
            );
            $this->User->bindModel(array('hasOne' => array('UsersYears','UserPoint')), false);
            $params['conditions']['UsersYears.year_id'] = $year_id;
            $params['contain']                          = array(
                'UserProfile' => array(
                    'School',
                    'SchoolCity'
                ),
                'UserPoint' => array(
                    'conditions' => array(
                        'UserPoint.year' => $year_id + 12
                    )
                ),
                'UsersYears'
            );


            // Alle, Rangordnung nach erreichter Punktzahl
            if ($mode == 0)
            {
                $users = $this->User->find('all', $params);
                $this->set('users', $users);
                $this->set('isLatin1', ($this->request->data['User']['output_charset'] == 'latin1'));
            }

            // Anzahl der Teilnehmer einer Hochschule, die X-Fragebögen ausgefüllt haben
            elseif ($mode == 1)
            {
                $searchYear = $year_id + 12;
                $result     = $this->User->query(
                    "SELECT COUNT(*) AS forms_completed, `schools`.`id`, `schools`.`name`
                    FROM `forms_users`
                    LEFT JOIN `forms` ON `forms_users`.`form_id` = `forms`.`id`
                    LEFT JOIN `users` ON `users`.`id` = `forms_users`.`user_id`
                    LEFT JOIN `user_profiles` ON `user_profiles`.`user_id` = `users`.`id`
                    LEFT JOIN `schools` ON `schools`.`id` = `user_profiles`.`school_id`
                    WHERE `forms_users`.`next_question`=0 AND `forms`.`year`={$searchYear}
                    GROUP BY `forms_users`.`user_id`
                    HAVING forms_completed={$formscount}"
                );

                $schoolCount = array();
                $schools     = array();

                foreach ($result as $data)
                {
                    $data = $data['schools'];
                    if (isset($schools[$data['id']]))
                    {
                        $schoolCount[$data['id']]++;
                    }
                    else
                    {
                        $schools[$data['id']]     = $data['name'];
                        $schoolCount[$data['id']] = 1;
                    }
                }
                $this->set('formscount', $formscount);
                $this->set('schools', $schools);
                $this->set('schoolCount', $schoolCount);
                $this->set('isLatin1', ($this->request->data['User']['output_charset'] == 'latin1'));
                $this->render('admin_report_schoolformcount');
            }


            // Alle, die sich noch nicht zurückgemeldet haben
            elseif ($mode == 2)
            {
                /* Export nicht zurückgemeldete User */
                /* Get year before */
                $lastYear = $this->User->Year->find('first', array('conditions'=>array('Year.id <>' => CURRENT_YEAR_ID), 'order' => array('title DESC'),));
                if (!empty($lastYear['Year']['id'])) {
                    $conditionsMode1 = array(
                        'User.role' => 'user',
                        'User.deleted' => 0,
                        'User.doubleoptin' => 0,
                        'UsersYears.year_id' => $lastYear['Year']['id']
                    );
                    $users = $this->User->find('all', array('conditions' => $conditionsMode1, 'contain' => array('UsersYears')));
                    foreach ($users as $user) {
                        $user['User']['doubleoptin_hash'] = sha1(serialize($user['User']) . time(true));
                        $fieldlist = array('User' => array('doubleoptin_hash'));
                        $this->User->id = $user['User']['id'];
                        $this->User->save($user, array('validate' => false, 'fieldList' => $fieldlist));
                    }

                    unset($users);
                    $users  = $this->User->find('all', array(
                                        'conditions' => $conditionsMode1,
                                        'contain' => array(
                                            'UserProfile' => array(
                                                'fields' => array('gender','firstname','surname'),
                                            ),
                                            'UsersYears'
                                        ),
                                        'fields' => array('email','doubleoptin_hash')

                        ));
                    $this->set('users', $users);
                    $this->set('isLatin1', ($this->request->data['User']['output_charset'] == 'latin1'));
                    $this->render('admin_report_noresponse');
                }
            }
            elseif ($mode == 3)
            {
                $query       = 'SELECT id FROM answers WHERE question_id = ' . intval($this->request->data['User']['question']) . ' ORDER BY id asc';
                $result      = $this->User->query($query);
                $answerOrder = array();
                $aO          = 1;
                foreach ($result as $k => $v)
                {
                    $answerOrder[$v['answers']['id']] = $aO;
                    $aO++;
                }

                $query               = 'SELECT answer_id, t2.username, t3.firstname as vorname, t3.surname as nachname FROM
                                        questions_users t1, users t2, user_profiles t3
                                        WHERE question_id = ' . intval($this->request->data['User']['question']) . ' AND t1.user_id = t2.id AND t3.user_id = t2.id
                                        GROUP BY t1.user_id';
                $result              = $this->User->query($query);
                $bonusQuestionResult = array();
                foreach ($result as $k => $v)
                {
                    $bonusQuestionResult[] = array(
                        'username'  => utf8_decode($v['t2']['username']),
                        'firstname' => utf8_decode($v['t3']['vorname']),
                        'surname'   => utf8_decode($v['t3']['nachname']),
                        'answer'    => $answerOrder[$v['t1']['answer_id']]
                    );
                }
                $this->set('data', $bonusQuestionResult);
                $this->set('isLatin1', ($this->request->data['User']['output_charset'] == 'latin1'));
                $this->render('admin_report_special');
            }
        }

        public function admin_report_form()
        {
            $params = array(
                'conditions' => array('Question.points' => 0),
                'recursive'  => 1,
                'order'      => 'Question.online_date desc'
            );

            $bonus     = array();
            $questions = $this->User->Question->find('all', $params);
            foreach ($questions as $question)
            {
                $bonus[$question['Question']['id']] = 'Fragebogen ' . $question['Form']['title'] . '/' . $question['Form']['year'];
            }
            $this->set('bonus', $bonus);
        }


        /* Catalog */
        public function index($occupation = null, $year = null)
        {
            if (!$year)
            {
                $year = isset($this->request->params['named']['year']) ? $this->request->params['named']['year'] : 13;
            }

            if($year <= 15)
            {
                $this->indexClassic2015($occupation, $year);
                return;
            }

            $occupation = isset($this->request->params['named']['occupation']) ? $this->request->params['named']['occupation'] : '';
            $this->User->recursive = 0;
            $this->User->unbindModel(
                array('hasOne' => array('UserPoint')),false
            );

            $conditionsMaster = array(
                'UserCatalog.year' => $year,
                'UserCatalog.degree' => 'Master'
            );

            $conditionsBachelor = array(
                'UserCatalog.year' => $year,
                'UserCatalog.degree' => 'Bachelor'
            );

            $occupations = array(
                'Praktikum'      => 'Praktikum',
                'Diplomarbeit'   => 'Diplomarbeit',
                'Teilzeitstelle' => 'Teilzeitstelle',
                'Vollzeitstelle' => 'Vollzeitstelle',
            );

            $limit = 10;
            $order = array('UserCatalog.rank' => 'ASC', 'UserProfile.surname' => 'ASC');
            $page = isset($this->params['named']['page']) ? $this->params['named']['page'] : 1;

            // Wievele Masters und Bachelors gibt es?
            $masterCount = $this->User->find('count', array('conditions' => $conditionsMaster));
            $bachelorCount = $this->User->find('count', array('conditions' => $conditionsBachelor));

            $most = null;

            // Gibt mehr Bachelors
            $key = 'Bachelor';
            if($bachelorCount >= $masterCount)
            {
                $this->set('most', $key);
                $most = $key;
            }
            // Bachelors holen
            $conditions = $conditionsBachelor;
            if (!empty($occupation))
            {
                $conditions['UserProfile.beschaeftigungsart'] = $occupation;
            }
            $paginationBachelor = array
            (
                'conditions' => $conditions,
                'limit' => $limit,
                'order' => $order,
                'page' => $page
            );
            $this->paginate = $paginationBachelor;
            $this->set($key, $this->paginate());

            // Gibt mehr Masters
            $key = 'Master';
            if($bachelorCount < $masterCount)
            {
                $this->set('most', $key);
                $most = $key;
            }
            // Masters holen
            $conditions = $conditionsMaster;
            if (!empty($occupation))
            {
                $conditions['UserProfile.beschaeftigungsart'] = $occupation;
            }
            $paginationMaster = array
            (
                'conditions' => $conditions,
                'limit' => 10,
                'order' => $order,
                'page' => $page
            );
            $this->paginate = $paginationMaster;
            $this->set($key, $this->paginate());

            // Paginator für die Ausgabe setzen
            // Nur beim Bachelor nötig, denn der Master wurde zuletzt Paginiert.
            if($most === 'Bachelor')
            {
                $this->paginate = $paginationBachelor;
                $this->paginate();
            }

            // Template Variablen
            $this->set('year', $year);
            $this->set('occupations', $occupations);
            $this->set('occupation', $occupation);
            $this->set('maxPoints', $this->User->Form->getTotalPoints($year));
            $this->render('index_2016');

            //$this->rankByPoints('Master', $year);
            //$this->rankByPoints('Bachelor', $year);
        }

        /**
         * Nummeriert die Ränge anhand der Punktzahl neu
         *
         * @param (string) $degree "Master" oder "Bachelor"
         * @param (int) $year Jahreszahl
         */
        public function rankByPoints($degree, $year)
        {
            $res = $this->User->query("SELECT `id` FROM `user_catalogs` WHERE `year`=$year AND `degree` LIKE '$degree' ORDER BY `points` DESC");
            $i = 1;
            foreach($res as $key => $value)
            {
                $this->User->query("UPDATE `user_catalogs` SET `rank`=$i WHERE `id`={$value['user_catalogs']['id']} LIMIT 1");
                $i++;
            }
        }

        public function indexClassic2015($occupation = null, $year = null)
        {
            Configure::write('debug', 0);

            $occupation = isset($this->request->params['named']['occupation']) ? $this->request->params['named']['occupation'] : '';


            $this->paginate = array(
                'order' => array(
                    'UserCatalog.rank'    => 'ASC',
                    'UserProfile.surname' => 'ASC'
                ),
                'limit' => 21
            );

            $this->User->recursive = 0;
            $this->User->unbindModel(
                array('hasOne' => array('UserPoint')),false
            );

            $conditions = array(
                'UserCatalog.year' => $year
            );

            if (!empty($occupation))
            {
                $conditions['UserProfile.beschaeftigungsart'] = $occupation;
            }

            $occupations = array(
                'Praktikum'      => 'Praktikum',
                'Diplomarbeit'   => 'Diplomarbeit',
                'Teilzeitstelle' => 'Teilzeitstelle',
                'Vollzeitstelle' => 'Vollzeitstelle',
            );

            $users = $this->paginate($conditions);
            $this->set('users', $users);
            $this->set('year', $year);
            $this->set('occupations', $occupations);
            $this->set('occupation', $occupation);
            $this->set('maxPoints', $this->User->Form->getTotalPoints($year));


            $this->set('year', $year);

            if(!empty($this->params['classic']))
            {
                $this->render('index_classic2015');
            }
        }


        public function view($id = null, $year = null)
        {
            if (!$id || !$year)
            {
                $this->Session->setFlash('Ungültiger Aufruf');
                $this->redirect(array(
                    'controller' => 'users',
                    'action'     => 'index'
                ));
            }

            // fetch data
            $this->User->Behaviors->attach('Containable');
            $this->User->contain(array(
                'UserProfile' => array('School' => array('SchoolCity')),
                'UserCatalog.year=' . $year
            ));

            $user = $this->User->read(null, $id);

            if (empty($user['UserCatalog']['year']))
            {
                $this->Session->setFlash('Ungültiger Aufruf');
                $this->redirect(array(
                    'controller' => 'users',
                    'action'     => 'index'
                ));
            }

            $this->set('year', $user['UserCatalog']['year']);
            $this->set('user', $user);
        }

        function captcha()
        {
//uncomment  the code below if the captcha doesn't render on localhost,For Unix/Linux Servers it works fine.
            $this->Captcha->configCaptcha(array(
                'pathType' => 2
            ));
            $this->Captcha->getCaptcha();
        }

        public function contact($id = null)
        {
            if (!$id)
            {
                $this->Session->setFlash('Ungültiger Aufruf');
                $this->redirect(array(
                    'controller' => 'users',
                    'action'     => 'index'
                ));
            }

            // fetch data
            $this->User->recursive = 0;
            $user                  = $this->User->read(null, $id);
            if (empty($user['UserCatalog']['year']))
            {
                $this->Session->setFlash('Ungültiger Aufruf');
                $this->redirect(array(
                    'controller' => 'users',
                    'action'     => 'index'
                ));
            }

            // send message
            if (!empty($this->data) && !empty($this->data['User']['text']))
            {
                if (true || $this->Captcha->validateCaptcha())
                {
                    $opts = array('carriage' => true);
                    $enc  = array('encode' => false);
                    $text = 'Hallo ' . $user['UserProfile']['firstname'] . ' ' . $user['UserProfile']['surname'] . PHP_EOL . PHP_EOL .
                        'Es wurde über das Kontaktformular eine Anfrage an sie übermittelt.' . PHP_EOL .
                        'Name: ' . h($this->data['User']['name']) . PHP_EOL .
                        'Firma: ' . h($this->data['User']['firma']) . PHP_EOL .
                        'E-Mail: ' . h($this->data['User']['email']) . PHP_EOL .
                        'Nachricht: ' . h($this->data['User']['text']);

                    App::uses('CakeEmail', 'Network/Email');
                    $mail = new CakeEmail();
                    $mail->from('noreply@springer.com')
                        ->to($user['User']['email'])
                        ->subject('Nachricht von ' . SITE_NAME)
                        ->send($text);

                    $this->Session->setFlash('Die Nachricht wurde verschickt');
                    $this->redirect(array('action' => 'index'));
                }
            }

            $this->set('user', $user);
        }

        public function getYearFromParams()
        {
            $year = isset($this->params['data']['User']['year']) ? $this->params['data']['User']['year'] : 0;
            switch ($year)
            {
                case 0:
                    $year = DEFAULT_YEAR;
                    break;
                case ($year > $this->currentYear):
                    $year = $this->currentYear;
                    break;
                case ($year < 9):
                    $year = FIRST_YEAR;
                    break;
            }
            return $year;
        }

        public function admin_excel($year_id=null){
            $this->layout = 'blank';
            $year_id = CURRENT_YEAR_ID;
            Configure::write('debug', 2);
            ini_set('memory_limit', '512M');
            set_time_limit(600);


            if($year_id){
                $year_id = (int)$year_id;
            }elseif(!empty($this->params['named']['year_id'])) {
                $year_id = (int)$this->params['named']['year_id'];
            }elseif(!empty($this->request->data['User']['year_id'])) {
                $year_id = (int)$this->request->data['User']['year_id'];
            }  else {
                $year_id = CURRENT_YEAR_ID;
            }


            $this->loadModel('Form');

            $formsContain = array(
                'Question'=>array(
                    'fields' => array('id','question','points'),
                    'Answer' => array('fields' => array('id','answer','correct'))
                )
            );
            $forms = array();
            $formsArray = $this->Form->find('all',array('conditions'=>array('year'=>$year_id+12),'order' => array('Form.online_date'   => 'asc'),'contain'=>$formsContain));
            foreach($formsArray as $form){
                $tmp = array();
                $tmp['id'] = $form['Form']['id'];
                $tmp['title'] = $form['Form']['title'];
                $tmp['id'] = $form['Form']['id'];
                $tmp['questions'] = array();
                foreach($form["Question"] as $question){
                    $tmpQuestion = array(
                        'id' => $question['id'],
                        'question' => $question['question'],
                        'points' => $question['points'],
                        'answers' => array()
                    );
                    foreach($question['Answer'] as $answer){
                        $tmpQuestion['answers'][] = array(
                            'id' => $answer['id'],
                            'answer' => $answer['answer'],
                            'correct' => $answer['correct']
                        );
                    }
                    $tmp['questions'][] = $question;
                }
                $forms[] = $tmp;
            }
            $this->set('forms',$forms);


            $conditions = array(
                'UsersYears.year_id' => $year_id
            );

            $this->User->unbindModel(
                array(
                    'hasOne'  => array('UserCatalog')
                ), false
            );

            $this->User->bindModel(array('hasOne' => array('UserPoint')), false);
            $this->User->bindModel(array('hasOne' => array('UsersYears')), false);

            $contain = array(
                'UserProfile'=>array('firstname','surname'),
                'UserPoint' => array(
                    'conditions' => array(
                        'UserPoint.year' => $year_id + 12
                    )
                ),
                'UsersYears',
                'Question'
            );


           $param = array(
               'conditions' => $conditions,
               'limit' => 1000,
               'contain' => $contain,
               'fields' => array('id','username','email')
           );
           $users = $this->User->find('all',$param);


         foreach($users as $key => $user){
             $tmpQuestions = array();
             if(!empty($user['Question'])){
                 foreach($user['Question'] as $question){
                     $tmpQuestions[$question['id']] = $question['QuestionsUser']['answer_id'];
                 }
             }
             $users[$key]['Question'] = $tmpQuestions;
         }

            $this->set('year_id', $year_id);
            $this->set('users', $users);

        }

        /**
         * beforeFilter
         *
         * @param
         * @return void
         */
        public function beforeFilter()
        {
            parent::beforeFilter();
            $currentYear       = (int)date('y');
            $this->currentYear = $currentYear;
            $this->set('currentYear', $currentYear);

            $this->Session->write('Navi', 'Users');

            $year       = $this->getYearFromParams();
            $this->year = $year;
            $this->set('year', $year);

            $this->Auth->allow('newpw', 'login', 'logout', 'add', 'registered', 'doubleoptin', 'complete_profile', 'doubleoptin_rsnd', 'pwlost', 'pwnew', 'index', 'view', 'contact');
            $this->Auth->autoRedirect = false;
        }
    }
