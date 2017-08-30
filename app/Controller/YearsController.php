<?php
App::uses('AppController', 'Controller');
/**
 * Years Controller
 *
 * @property Year $Year
 */
class YearsController extends AppController {

    public $paginate = array(
        'limit' => 25,
        'order' => array(
            'Year.title'        => 'desc'
        )
    );

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Year->recursive = 0;
		$this->set('years', $this->paginate());
	}


/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Year->create();
			if ($this->Year->save($this->request->data)) {
				$this->Session->setFlash(__('Das Jahr wurde angelegt.'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The year could not be saved. Please, try again.'));
			}
		}
	}

    /**
     * admin_reinitialize method
     *
     * @return void
     */
    public function admin_reinitialize() {
       $this->Year->initYear();
       $this->autoRender = false;
    }
}
