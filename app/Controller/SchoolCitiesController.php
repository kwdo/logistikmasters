<?php
App::uses('AppController', 'Controller');
/**
 * SchoolCities Controller
 *
 * @property SchoolCity $SchoolCity
 */
class SchoolCitiesController extends AppController {

public $paginate = array(    
		'limit' => 25,  
        'order' => array(
        	'SchoolCity.notchecked' => 'desc',
        	'SchoolCity.sorting' => 'asc',
            'SchoolCity.name' => 'asc'
        )
    );


/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
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
	public function admin_view($id = null) {
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
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->SchoolCity->create();
			if ($this->SchoolCity->save($this->request->data)) {
				$this->Session->setFlash(__('Der Ort wurde gespeichert'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Der Ort konnte nicht gespeichert werden'));
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
	public function admin_edit($id = null) {
		$this->SchoolCity->id = $id;
		if (!$this->SchoolCity->exists()) {
			throw new NotFoundException(__('Unbekannter Ort'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->SchoolCity->save($this->request->data)) {
				$this->Session->setFlash(__('Der Ort wurde gespeicheichert'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Der Ort konnte nicht gespeichert werden'));
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
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->SchoolCity->id = $id;
		if (!$this->SchoolCity->exists()) {
			throw new NotFoundException(__('Unbekannter Ort'));
		}
		if ($this->SchoolCity->delete()) {
			$this->Session->setFlash(__('Der Ort wurde gelöscht'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Der Ort konnte nicht gelöscht werden'));
		$this->redirect(array('action' => 'index'));
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
    }
}
