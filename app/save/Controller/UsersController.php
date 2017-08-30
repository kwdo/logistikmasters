<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

    public $helpers = array('Js');

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
            $this->request->data['User']['doubleoptin_hash'] = sha1(serialize($this->request->data['User']) . time(true));
			if ($this->User->saveAll($this->request->data)) {
                App::uses('CakeEmail', 'Network/Email');
                $mail = new CakeEmail();
                $mail->from('logistikmasters@springer.com')
                    ->to($this->request->data['User']['email'])
                    ->subject('DoubleOptIn von Best Azubi')
                    ->send('Hallo ' . $this->request->data['Profile']['firstname'] . ' ' . $this->request->data['Profile']['lastname'] . ',' . PHP_EOL . PHP_EOL .
                    'um am Wezttbewerb teilzunehmen, musst Du Deinen Account über folgenden Link aktivieren: ' . PHP_EOL .
                    'http://' . $_SERVER['HTTP_HOST'] . '/users/doubleoptin/' . $this->request->data['User']['doubleoptin_hash'] . PHP_EOL . PHP_EOL . 'Dein Logistik Masters Team');

                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'registered'));
			} else {
				$this->Session->setFlash('Bitte überprüfe Deine Eingaben');
			}
		}
		$forms = $this->User->Form->find('list');
		$questions = $this->User->Question->find('list');
        $schoolCities = $this->User->Profile->SchoolCity->find('list');
        $schools = $this->User->Profile->School->find('list');
        $this->set(compact('schools','schoolCities'));
	}


    /**
     * add method
     *
     * @return void
     */
    public function admin_add() {
        if ($this->request->is('post')) {
            $this->User->create();
            $this->request->data['User']['doubleoptin_hash'] = sha1(serialize($this->request->data['User']) . time(true));
            if ($this->User->saveAll($this->request->data)) {
                App::uses('CakeEmail', 'Network/Email');
                $mail = new CakeEmail();
                $mail->from('logistikmasters@springer.com')
                    ->to($this->request->data['User']['email'])
                    ->subject('DoubleOptIn von Best Azubi')
                    ->send('Hallo ' . $this->request->data['Profile']['firstname'] . ' ' . $this->request->data['Profile']['lastname'] . ',' . PHP_EOL . PHP_EOL .
                    'um am Wezttbewerb teilzunehmen, musst Du Deinen Account über folgenden Link aktivieren: ' . PHP_EOL .
                    'http://' . $_SERVER['HTTP_HOST'] . '/users/doubleoptin/' . $this->request->data['User']['doubleoptin_hash'] . PHP_EOL . PHP_EOL . 'Dein Logistik Masters Team');

                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'registered'));
            } else {
                $this->Session->setFlash('Bitte überprüfe Deine Eingaben');
            }
        }
        $forms = $this->User->Form->find('list');
        $questions = $this->User->Question->find('list');
        $schoolCities = $this->User->Profile->SchoolCity->find('list');
        $schools = $this->User->Profile->School->find('list');
        $this->set(compact('schools','schoolCities'));
    }


    /**
     * doubleoptin after register, Updates the notify_on_activity field
     *
     * @param $key      find user by given key
     * @return void
     */
    public function doubleoptin($key = null) {
        $this->set(array(
        ));

        if ($key == null) {
            $this->Session->setFlash('Der Benutzer konnte nicht gefunden werden');
            $this->redirect(array('action' => 'add'));
            return;
        }

        $this->User->recursive = -1;
        $user = $this->User->find('first', array('conditions' => array('doubleoptin_hash' => $key, 'doubleoptin' => 0),
            'fields' => array('id', 'email')));

        if ($user) {
            $user['User']['doubleoptin_hash'] = '';
            $user['User']['doubleoptin'] = '1';

            $this->User->id = $user['User']['id'];
            $this->User->save($user, array('validate' => false));

            $this->Session->setFlash('Ihr Account wurde aktiviert. Viel Spass beim Wettbewerb', 'default', array('class' => 'success'));
        } else {
            $this->Session->setFlash('Der Benutzer konnte nicht gefunden werden');
        }
        $this->redirect(array('controller' => 'forms', 'action' => 'index'));
        ;
    }


    /**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
		}
		$forms = $this->User->Form->find('list');
		$questions = $this->User->Question->find('list');
		$this->set(compact('forms', 'questions'));
	}


    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
        }
        $forms = $this->User->Form->find('list');
        $questions = $this->User->Question->find('list');
        $this->set(compact('forms', 'questions'));
    }

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Unbekannter Username oder falsches Passwort. Bitte versuche es erneut.'));
            }
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }


    /**
     * registered method
     *
     * @return void
     */
    public function registered() {

    }

    /**
     * beforeFilter
     *
     * @param
     * @return void
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','add','registered','doubleoptin');
    }
}
