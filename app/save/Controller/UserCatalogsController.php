<?php
App::uses('AppController', 'Controller');
/**
 * UserCatalogs Controller
 *
 * @property UserCatalog $UserCatalog
 */
class UserCatalogsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->UserCatalog->recursive = 0;
		$this->set('userCatalogs', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->UserCatalog->id = $id;
		if (!$this->UserCatalog->exists()) {
			throw new NotFoundException(__('Invalid user catalog'));
		}
		$this->set('userCatalog', $this->UserCatalog->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UserCatalog->create();
			if ($this->UserCatalog->save($this->request->data)) {
				$this->Session->setFlash(__('The user catalog has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user catalog could not be saved. Please, try again.'));
			}
		}
		$users = $this->UserCatalog->User->find('list');
		$olds = $this->UserCatalog->Old->find('list');
		$tmps = $this->UserCatalog->Tmp->find('list');
		$this->set(compact('users', 'olds', 'tmps'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->UserCatalog->id = $id;
		if (!$this->UserCatalog->exists()) {
			throw new NotFoundException(__('Invalid user catalog'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->UserCatalog->save($this->request->data)) {
				$this->Session->setFlash(__('The user catalog has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user catalog could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->UserCatalog->read(null, $id);
		}
		$users = $this->UserCatalog->User->find('list');
		$olds = $this->UserCatalog->Old->find('list');
		$tmps = $this->UserCatalog->Tmp->find('list');
		$this->set(compact('users', 'olds', 'tmps'));
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
		$this->UserCatalog->id = $id;
		if (!$this->UserCatalog->exists()) {
			throw new NotFoundException(__('Invalid user catalog'));
		}
		if ($this->UserCatalog->delete()) {
			$this->Session->setFlash(__('User catalog deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User catalog was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
