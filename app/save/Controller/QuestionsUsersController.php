<?php
App::uses('AppController', 'Controller');
/**
 * QuestionsUsers Controller
 *
 * @property QuestionsUser $QuestionsUser
 */
class QuestionsUsersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->QuestionsUser->recursive = 0;
		$this->set('questionsUsers', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->QuestionsUser->id = $id;
		if (!$this->QuestionsUser->exists()) {
			throw new NotFoundException(__('Invalid questions user'));
		}
		$this->set('questionsUser', $this->QuestionsUser->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->QuestionsUser->create();
			if ($this->QuestionsUser->save($this->request->data)) {
				$this->Session->setFlash(__('The questions user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The questions user could not be saved. Please, try again.'));
			}
		}
		$questions = $this->QuestionsUser->Question->find('list');
		$users = $this->QuestionsUser->User->find('list');
		$answers = $this->QuestionsUser->Answer->find('list');
		$this->set(compact('questions', 'users', 'answers'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->QuestionsUser->id = $id;
		if (!$this->QuestionsUser->exists()) {
			throw new NotFoundException(__('Invalid questions user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->QuestionsUser->save($this->request->data)) {
				$this->Session->setFlash(__('The questions user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The questions user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->QuestionsUser->read(null, $id);
		}
		$questions = $this->QuestionsUser->Question->find('list');
		$users = $this->QuestionsUser->User->find('list');
		$answers = $this->QuestionsUser->Answer->find('list');
		$this->set(compact('questions', 'users', 'answers'));
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
		$this->QuestionsUser->id = $id;
		if (!$this->QuestionsUser->exists()) {
			throw new NotFoundException(__('Invalid questions user'));
		}
		if ($this->QuestionsUser->delete()) {
			$this->Session->setFlash(__('Questions user deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Questions user was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
