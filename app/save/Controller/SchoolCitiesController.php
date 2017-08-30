<?php
App::uses('AppController', 'Controller');
/**
 * SchoolCities Controller
 *
 * @property SchoolCity $SchoolCity
 */
class SchoolCitiesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->SchoolCity->recursive = 0;
		$this->set('schoolCities', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->SchoolCity->id = $id;
		if (!$this->SchoolCity->exists()) {
			throw new NotFoundException(__('Invalid school city'));
		}
		$this->set('schoolCity', $this->SchoolCity->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->SchoolCity->create();
			if ($this->SchoolCity->save($this->request->data)) {
				$this->Session->setFlash(__('The school city has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The school city could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->SchoolCity->id = $id;
		if (!$this->SchoolCity->exists()) {
			throw new NotFoundException(__('Invalid school city'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->SchoolCity->save($this->request->data)) {
				$this->Session->setFlash(__('The school city has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The school city could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->SchoolCity->read(null, $id);
		}
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
		$this->SchoolCity->id = $id;
		if (!$this->SchoolCity->exists()) {
			throw new NotFoundException(__('Invalid school city'));
		}
		if ($this->SchoolCity->delete()) {
			$this->Session->setFlash(__('School city deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('School city was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
