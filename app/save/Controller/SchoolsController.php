<?php
App::uses('AppController', 'Controller');
/**
 * Schools Controller
 *
 * @property School $School
 */
class SchoolsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->School->recursive = 0;
		$this->set('schools', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->School->id = $id;
		if (!$this->School->exists()) {
			throw new NotFoundException(__('Invalid school'));
		}
		$this->set('school', $this->School->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->School->create();
			if ($this->School->save($this->request->data)) {
				$this->Session->setFlash(__('The school has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The school could not be saved. Please, try again.'));
			}
		}
		$schoolCities = $this->School->SchoolCity->find('list');
		$this->set(compact('schoolCities'));
	}
	
    public function getByCity() {
        $city_id = $this->request->data['Profile']['school_city_id'];

        $schools = $this->School->find('list', array(
            'conditions' => array('School.school_city_id' => $city_id),
            'recursive' => -1
        ));


        if($city_id != 96){
            $schools[354] = '<b>Nicht in Liste</b>';
        }

        $this->set('schools',$schools);
        $this->layout = 'ajax';
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->School->id = $id;
		if (!$this->School->exists()) {
			throw new NotFoundException(__('Invalid school'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->School->save($this->request->data)) {
				$this->Session->setFlash(__('The school has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The school could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->School->read(null, $id);
		}
		$schoolCities = $this->School->SchoolCity->find('list');
		$this->set(compact('schoolCities'));
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
		$this->School->id = $id;
		if (!$this->School->exists()) {
			throw new NotFoundException(__('Invalid school'));
		}
		if ($this->School->delete()) {
			$this->Session->setFlash(__('School deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('School was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
