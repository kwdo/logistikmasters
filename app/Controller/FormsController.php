<?php
class FormsController extends AppController
{
	public $cacheAction = true;
	public $helpers = array('Html', 'Form', 'Time', 'Js', 'Csv');

	public function home() {
		$this->redirect(REDIRECT_URL);
	}

	public function index() {
        $configCustom = Configure::read('custom_settings');
		if($this->loggedIn) {

			$this->Form->unbindModel(array(
				'hasMany' => array('Question')
			));
			$this->Form->hasAndBelongsToMany['User']['conditions'] = 'User.id = '.$this->loggedIn;
			$recursive = 1;

			// insert stats row
			$this->Form->User->UserPoint->initStatsRow($this->loggedIn);
            $points = $this->Form->User->UserPoint->getStatsRow($this->loggedIn);
            $this->set('points',$points);
		} else {
			$recursive = 0;
		}
		$this->Form->bindModel(array('hasOne' => array(
			'Question' => array('conditions' => 'Question.order = 0')
		)));

		$params = array(
			'fields' => 'Form.*, Question.id',
			'recursive' => $recursive,
			'conditions' => array(
				'year' => CURRENT_YEAR - 2000
			)
		);
		// admin can view all forms
		if(!$this->Session->read('adminValid')) {
			$params['conditions']['Form.online_date <='] = date("Y-m-d");
		}

		$forms = $this->Form->find('all', $params);
        $this->set('enddate',$configCustom['competion_end']);
        $this->set('show_points_in_profile',$configCustom['show_points_in_profile']);
		$this->set('forms', $forms);
		$this->set('isAdmin', $this->Session->read('adminValid'));
	}

	public function print_view($id = 0) {
		if(!$this->loggedIn) {
			$this->Session->setFlash('Sie sind noch nicht eingeloggt.<br />
				Bitte loggen Sie sich ein bzw. registrieren Sie sich, um bei '.SITE_NAME.' teilzunehmen.');
			$this->redirect(array('controller' => 'forms', 'action' => 'index'));
		}
		if(!$id) {
			$this->Session->setFlash('Ungültiger Fragebogen.');
			$this->redirect(array('controller' => 'forms', 'action' => 'index'));
		}
		if(IS_BEST_AZUBI) {
			$this->layout = 'print_ba';
		} else {
			$this->layout = 'print_lm';
		}

		$this->Form->recursive = 2;
		$this->Form->contain(array('Question', 'Question.Answer', 'Question.User.id='.$this->loggedIn));
		$form = $this->Form->findById($id);
		$this->set('formData', $form);
	}

	public function finished() { }

	public function admin_index() {
        $this->Session->write('Forum.isAdmin', true);
		$this->Form->recursive = -1;
		$this->set('forms', $this->paginate('Form', array('year' => CURRENT_YEAR - 2000)));
	}


	public function admin_view($id = 0) {
		if(!$id) {
			$this->Session->setFlash('Ungültiger Fragebogen');
			$this->redirect(array('action'=>'index'));
		}

		$this->Form->unbindModel(array(
			'hasAndBelongsToMany' => array('User')
		));

		$this->Form->recursive = 1;
		$this->set('formData', $this->Form->read(null, $id));
	}

    public function admin_view_statistics($id = 0) {
        if(!$id) {
            $this->Session->setFlash('Ungültiger Fragebogen');
            $this->redirect(array('action'=>'index'));
        }
        $this->Form->recursive = 1;
        $this->Form->unbindModel(array(
            'hasAndBelongsToMany' => array('User')
        ));
        $form = $this->Form->read(null, $id);



        foreach($form['Question'] as $key=>$value){
            $question_users = $this->Form->query("SELECT count(user_id) as anzahl FROM  questions_users WHERE question_id=" . $value['id'] . " GROUP BY question_id");
            $answers = $this->Form->query("SELECT id,answer,correct FROM answers WHERE question_id=$value[id]");
            $form['Question'][$key]['user_count'] = $question_users[0][0]['anzahl'];
            foreach($answers as $a_key => $a_value){
                $answer = array('title'=>$a_value['answers']['answer'],'correct'=>$a_value['answers']['correct']);
                $answers_users = $this->Form->query("SELECT count(user_id) as anzahl FROM  questions_users WHERE answer_id=" . $a_value['answers']['id'] . " GROUP BY answer_id");
                $answer['user_count'] = $answers_users[0][0]['anzahl'];
                $form['Question'][$key]['Answers'][] = $answer;
            }


        }


        $this->set('formData', $form);
    }

	public function admin_add() {
		if(!empty($this->request->data)) {
			$this->request->data['Form']['year'] = CURRENT_YEAR - 2000;
            $data = $this->request->data;
            debug($data);
			if($this->Form->save($data, array('fieldList'=>array('title','online_date','year')))) {
                $data['Form']['id'] = $this->Form->getInsertID();
                $result = $this->Form->updateFile($data);
				$this->Session->setFlash('Der Fragebogen wurde gespeichert');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('Der Fragebogen konnte nicht gespeichert werden, bitte versuchen Sie es erneut.');
			}
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
        $this->Form->id = $id;
        if (!$this->Form->exists()) {
            throw new NotFoundException(__('Unbekannter Fragebogen'));
        }
        if ($this->Form->delete()) {
            $this->Session->setFlash(__('Fragebogen erfolgreich gelöscht'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Der Fragebogen konnte nicht gelöscht werden'));
        $this->redirect(array('action' => 'index'));
    }

	public function admin_edit($id = 0) {
		if(!$id && empty($this->request->data)) {
			$this->Session->setFlash('Ungültiger Fragebogen');
			$this->redirect(array('action'=>'index'));
		}
		if(!empty($this->request->data)) {
			if ($this->Form->save($this->request->data)) {
				$this->Session->setFlash('Der Fragebogen wurde gespeichert');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('Der Fragebogen konnte nicht gespeichert werden, bitte versuchen Sie es erneut.');
			}
		}
		if(empty($this->request->data)) {
			$this->request->data = $this->Form->read(null, $id);
		}
	}

	public function admin_user_edit($id = 0, $userId = 0) {
		$userId = (int)$userId;
		if((!$id || !$userId) && empty($this->request->data)) {
			$this->Session->setFlash('Ungültiger Aufruf');
			$this->redirect(array('controller' => 'users', 'action' => 'index'));
		}
		if(!empty($this->request->data)) {
            //es ist kein neuer Fragebogen

            if(empty($this->request->data['Form']['new'])){
                $this->Session->setFlash('Fragebögen können nicht geändert werden');
                $this->redirect(array('controller' => 'users', 'action' => 'view', $this->request->data['User']['userID']));
            }else{

			$id = (int)$this->request->data['Form']['id'];
			$userId = (int)$this->request->data['User']['userID'];

			foreach($this->request->data['Question'] as $key => $value) {
				$answer = (int)$value['Answer']['id'];
				if(!$answer) continue;

				if($this->request->data['Form']['new']) {
					$this->Form->query("INSERT IGNORE INTO questions_users
						SET question_id=$key, user_id=$userId, answer_id=$answer");
				} else {
					$this->Form->query("REPLACE INTO questions_users
					SET question_id=$key, user_id=$userId, answer_id=$answer");
				}
			}

			$this->Form->query("REPLACE INTO forms_users
				SET form_id=$id, user_id=$userId, next_question=0, modified=NOW(), mail=1");

			$this->Session->setFlash('Der Fragebogen wurde gespeichert');
			$this->redirect(array('controller' => 'users', 'action' => 'view', $userId));
       } 
		} else {
			$this->Form->recursive = 2;
			$this->Form->contain(array('Question', 'Question.Answer', 'Question.User.id='.$userId));
			$this->request->data = $this->Form->read(null, $id);
			$this->request->data['User']['userID'] = $userId;
		}
	}

	public function admin_report($id = 0) {
		$id = (int)$id;
		if(!$id) {
			$this->Session->setFlash('Ungültiger Aufruf');
			$this->redirect(array('controller' => 'users', 'action' => 'index'));
		}
		$this->layout = 'blank';
		Configure::write('debug', 0);

		$this->Form->Question->recursive = -1;
		$this->Form->Question->order = 'Question.id ASC';
		$questions = $this->Form->Question->findAllByFormId($id);

		$ids = array(0);
		foreach($questions as $question) {
			$ids[] = $question['Question']['id'];
		}

		$data = $this->Form->query('SELECT COUNT(*) AS count, Answer.answer
								    FROM questions_users QuestionsUser
								   		LEFT JOIN answers Answer ON Answer.id=QuestionsUser.answer_id
								   	WHERE QuestionsUser.question_id IN('.implode(',', $ids).')
								    GROUP BY QuestionsUser.question_id, QuestionsUser.answer_id
								    ORDER BY QuestionsUser.question_id ASC');

		$this->set('data', $data);
		$this->set('questions', $questions);
	}

    /**
     * beforeFilter
     *
     * @param
     * @return void
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Session->write('Navi', 'Forms');
        $this->Auth->allow('*');
        //$this->Auth->allow('initDB');
    }

}
