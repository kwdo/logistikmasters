<?php
App::uses('AppController', 'Controller');
/**
 * FormsUsers Controller
 *
 * @property FormsUser $FormsUser
 */
class FormsUsersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->FormsUser->recursive = 0;
		$this->set('formsUsers', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->FormsUser->id = $id;
		if (!$this->FormsUser->exists()) {
			throw new NotFoundException(__('Invalid forms user'));
		}
		$this->set('formsUser', $this->FormsUser->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->FormsUser->create();
			if ($this->FormsUser->save($this->request->data)) {
				$this->Session->setFlash(__('The forms user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The forms user could not be saved. Please, try again.'));
			}
		}
		$forms = $this->FormsUser->Form->find('list');
		$users = $this->FormsUser->User->find('list');
		$this->set(compact('forms', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->FormsUser->id = $id;
		if (!$this->FormsUser->exists()) {
			throw new NotFoundException(__('Invalid forms user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->FormsUser->save($this->request->data)) {
				$this->Session->setFlash(__('The forms user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The forms user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->FormsUser->read(null, $id);
		}
		$forms = $this->FormsUser->Form->find('list');
		$users = $this->FormsUser->User->find('list');
		$this->set(compact('forms', 'users'));
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->FormsUser->id = $id;
		if (!$this->FormsUser->exists()) {
			throw new NotFoundException(__('Invalid forms user'));
		}
		if ($this->FormsUser->delete()) {
			$this->Session->setFlash(__('Forms user deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Forms user was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
