<?php
App::uses('AppController', 'Controller');
/**
 * Schools Controller
 *
 * @property School $School
 */
class SchoolsController extends AppController {

	public $paginate = array(    
		'limit' => 25,  
        'order' => array(
        	'School.notchecked' => 'desc',
        	'School.sorting' => 'asc',
            'School.name' => 'asc'
        )
    );

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
        $this->Session->write('LastUrl', Router::url(null, true));
		//$this->School->recursive = 0;
		$this->set('schools', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
        $this->Session->write('LastUrl', Router::url(null, true));
		$this->School->id = $id;
		if (!$this->School->exists()) {
			throw new NotFoundException(__('Invalid school'));
		}
        $this->School->recursive = 2;
		$this->set('school', $this->School->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->School->create();
			if ($this->School->save($this->request->data)) {
				$this->Session->setFlash(__('Die Hochschule wurde gespeichert.'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Die Hochschule konnte nicht gespeichert werden.'));
			}
		}
		$schoolCities = $this->School->SchoolCity->find('list');
		$this->set(compact('schoolCities'));
	}
	
    public function getByCity() {
        $city_id = $this->request->data['UserProfile']['school_city_id'];

        $schools = $this->School->find('list', array(
            'conditions' => array('School.school_city_id' => $city_id),
            'recursive' => -1
        ));


        if($city_id != 244){
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
	public function admin_edit($id = null) {
		$this->School->id = $id;
		if (!$this->School->exists()) {
			throw new NotFoundException(__('Unbekannte Schule'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->School->save($this->request->data)) {
				$this->Session->setFlash(__('Die Schule wurde gespeichert'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Die Schule konnte nicht gespeichert werden'));
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
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->School->id = $id;
		if (!$this->School->exists()) {
			throw new NotFoundException(__('Unbekannte Schule'));
		}
		if ($this->School->delete()) {
			$this->Session->setFlash(__('Die Schule wurde gelöscht'));
		}else{
            $this->Session->setFlash(__('Die Schule konnte nicht gelöscht werden'));
        }
		$url = $this->Session->read('LastUrl') ? $this->Session->read('LastUrl') :  array('action' => 'index');
        $this->redirect($url);
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
        $this->Auth->allow('getByCity');
    }
}
