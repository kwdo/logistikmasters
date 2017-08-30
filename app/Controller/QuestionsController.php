<?php
class QuestionsController extends AppController
{
	public $helpers = array('Html', 'Form', 'Time', 'Js');
	public $cacheAction = true;	
	public function view($id = 0) {
		// TODO: Alte Fragebögen nicht mehr abrufbar machen!
		// BUG: Deaktivierte Nutzer können Fragebogen beantworten!

        $configCustom = Configure::read('custom_settings');

		// Closed?
		if(time() > $configCustom['competion_end']) {
			$this->Session->setFlash("Der Einsendeschluß ist verstrichen.");
			$this->redirect(array('controller' => 'forms', 'action' => 'index'));
		}
		
		if(!$this->loggedIn) {
			$this->Session->setFlash('Sie sind noch nicht eingeloggt.<br />
				Bitte loggen Sie sich ein bzw. registrieren Sie sich, um bei '.SITE_NAME.' teilzunehmen.');
			$this->redirect(array('controller' => 'forms', 'action' => 'index'));
		}

        /*
        if(!$this->activated) {
			$this->Session->setFlash('Ihr Konto wurde noch nicht aktiviert.<br />
				Bitte klicken Sie zuerst auf den Link in Ihrer Regristrierungsbestätigung.');
			$this->redirect(array('controller' => 'forms', 'action' => 'index'));
		}
        */

		if(!$id) {
			$this->redirect(array('controller' => 'forms', 'action' => 'index'));
		}

		// rebind models
		$this->Question->hasAndBelongsToMany['User']['conditions'] = 'User.id = '.$this->loggedIn;
		$question = $this->Question->findById($id);

		$this->Question->Form->unbindModel(array(
			'hasMany' => array('Question')
		));
		$this->Question->Form->hasAndBelongsToMany['User']['conditions'] = 'User.id = '.$this->loggedIn;
		$form = $this->Question->Form->findById($question['Form']['id']);
		
		// form comleted?
		$blocked = (time() > $configCustom['competion_end']);
		if(isset($form['User'][0]['FormsUser']['next_question'])) {
			$finished = $blocked = !($form['User'][0]['FormsUser']['next_question']);
			$this->set('finished', $finished);
		}

		// question over?
		$blocked = $blocked ? $blocked : $this->Question->blockedQuestion($question);
		
		// show video?
		if(isset($question['Question']['video_before']) && $question['Question']['video_before']) {
			$videoID = $question['Question']['video_before'];
			if($this->Question->blockedQuestion($question) && $finished) {
				$videoID = $question['Question']['video_after'];
			}
			$this->set('showVideo', $videoID);
		}
		
		// load neighbors
		$params = array(
			'conditions' => array('form_id' => $question['Form']['id']),
			'field' => 'Question.order',
			'value' => $question['Question']['order']
		);
		$neighbors = $this->Question->find('neighbors', $params);

		// get question count
		$params = array(
			'conditions' => array('form_id' => $question['Form']['id'])
		);
		$count = $this->Question->find('count', $params);

        $this->set('enddate',$configCustom['competion_end']);
        $this->set('blocked', $blocked);
		$this->set('question', $question);
		$this->set('neighbors', $neighbors);
		$this->set('questionCount', $count);
	}
	
	public function save() {
        $configCustom = Configure::read('custom_settings');

		if(!$this->loggedIn) {
			$this->Session->setFlash('Sie sind noch nicht eingeloggt.<br />
				Bitte loggen Sie sich ein bzw. registrieren Sie sich, um bei '.SITE_NAME.' teilzunehmen.');
			$this->redirect(array('controller' => 'forms', 'action' => 'index'));
		}

		$currentId = (int)$this->request->data['Question']['id'];
		$showId = isset($this->request->data['Question']['show']) ? (int)$this->request->data['Question']['show'] : $currentId;

		if(empty($this->request->data) || !$this->loggedIn || !$currentId || !$showId) {
			$this->Session->setFlash('Ungültiger Aufruf');
			$this->redirect(array('controller' => 'forms', 'action' => 'index'));
		}
		
		// get form
		$this->Question->recursive = 2;
		$this->Question->Behaviors->attach('Containable');
		$this->Question->contain('Form.User');
		$this->Question->Form->hasAndBelongsToMany['User']['conditions'] = 'User.id = '.$this->loggedIn;
		$question = $this->Question->findById($currentId);
		
		if(!$question) {
			$this->Session->setFlash('Ungültiger Aufruf');
			$this->redirect(array('controller' => 'forms', 'action' => 'index'));
		}	
		$nextQuestion = isset($question['Form']['User'][0]) ? $question['Form']['User'][0]['FormsUser']['next_question'] : -1;

		if($nextQuestion == 0 || $this->Question->blockedQuestion($question)) {
			$this->Session->setFlash('Die Frage wurde bereits abgeschlossen');
			$this->redirect(array('controller' => 'forms', 'action' => 'index'));
		}

		// don't skip questions
		if(!isset($this->request->data['Answer']['id'])) {
			$this->Session->setFlash('Bitte beantworten Sie zuerst diese Frage.');
			$this->redirect(array('action' => 'view', $currentId));
		}
		$answer = (int)$this->request->data['Answer']['id'];
		
		// save answer
		$this->Question->query("REPLACE INTO questions_users
			SET question_id=$currentId, user_id=$this->loggedIn, answer_id=$answer");
			
		if(isset($this->request->data['Question']['finished'])) {
			$nextId = 0;
		} else {
			$nextId = $currentId;
		}
		
		// Closed?
		if(time() <= $configCustom['competion_end']) {
			$this->updateForm($question['Question']['form_id'], $nextId);
		}

		if(isset($this->request->data['Question']['finished'])) {
			$this->redirect(array('controller' => 'forms', 'action' => 'finished'));
        }elseif(isset($this->request->data['Form']['send_to_overview'])){
            $this->Session->setFlash('Der Fragebogen wurde erfolgreich gespeichert', 'default', array('class' => 'success'));
            $this->redirect(array('controller' => 'forms', 'action' => 'index'));
		} else {
			$this->redirect(array('action' => 'view', $showId));			
		}
	}
	
	public function finish($formId) {
		$this->updateForm($formId, 0);
		$this->redirect(array('controller' => 'forms', 'action' => 'finished'));
	}
	
	private function updateForm($formId, $nextId) {	
		$this->Question->query("REPLACE INTO forms_users
			SET form_id=$formId, user_id=$this->loggedIn,
				next_question=$nextId, modified=NOW()");
	}
	
	public function admin_add($id = 0) {
		if(!$id && empty($this->request->data)) {
			$this->Session->setFlash('Ung?ltiger Fragebogen');
			$this->redirect(array('controller' => 'forms', 'action' => 'index'));
		}
		if(!empty($this->request->data)) {
			$this->Question->create();
			
			$params = array(
				'conditions' => array('Question.form_id' => $this->request->data['Question']['form_id'])
			);
			$this->request->data['Question']['order'] = $this->Question->find('count', $params);
			
			if($this->Question->saveAll($this->request->data)) {
				$this->Session->setFlash('Die Frage wurde gespeichert');
				$this->redirect(array('controller' => 'forms', 'action' => 'view', $this->request->data['Question']['form_id']));
			} else {
				$this->Session->setFlash('Die Frage konnte nicht gespeichert werden, bitte versuchen Sie es erneut.');
			}
		}
		$this->request->data['Question']['form_id'] = (int)$id;
		$this->request->data['Question']['points'] = 4;
	}
	
	public function admin_edit($id = 0) {
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash('Ungültige Frage');
            $this->redirect(array('controller' => 'forms', 'action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->Question->saveAll($this->request->data)) {
	            if($this->request->data['Question']['image_delete']){
		            $this->Question->read(null,$id);
		            @unlink('img/uploads/'.$id.'-'.$this->Question->data['Question']['image']);
		            $this->Question->set('image',null);
		            $this->Question->save();
	            }
	            $this->Session->setFlash('Die Frage wurde gespeichert');
                $this->redirect(array('controller' => 'forms', 'action' => 'view', $this->request->data['Question']['form_id']));
            } else {
                $this->Session->setFlash('Die Frage konnte nicht gespeichert werden, bitte versuchen Sie es erneut.');
            }
        } else {
            $this->Question->unbindModel(array(
                'hasAndBelongsToMany' => array('User'),
                'belongsTo' => array('Form')
            ));
            $this->request->data = $this->Question->read(null, $id);
        }
	}
	
	public function admin_delete($id = 0) {
		if(!$id && empty($this->request->data)) {
			$this->Session->setFlash('Ungültige Frage');
			$this->redirect(array('controller' => 'forms', 'action' => 'index'));
		}

		$question = $this->Question->read(null, $id);
		if($question['Question']['order'] == 0) {
			$this->Session->setFlash('Die Erste Frage darf nicht gelöscht werden. Bitte schieben Sie sie zuerst nach unten.');
			$this->redirect(array('controller' => 'forms', 'action' => 'view', $question['Question']['form_id']));
		}
		
		if($this->Question->delete($id)) {
			$this->Question->updateAll(
				array('`Question`.`order`' => '`Question`.`order` - 1'),
				array(
					'`Question`.`order` >' => $question['Question']['order'],
					'Question.form_id' => $question['Question']['form_id']
				)
			);
			$this->Session->setFlash('Die Frage wurde gelöscht.');
			$this->redirect(array('controller' => 'forms', 'action' => 'view', $question['Question']['form_id']));
		} else {
			$this->Session->setFlash('Die Frage konnte nicht gelöscht werden.');
			$this->redirect(array('controller' => 'forms', 'action' => 'index'));

		}
	}
	
	public function admin_up($id = 0) {
		$this->move($id, -1);
	}
	
	public function admin_down($id = 0) {
		$this->move($id, 1);
	}
	
	private function move($id, $direction) {
		if(!$id) {
			$this->Session->setFlash('Ungültige Frage');
			$this->redirect(array('controller' => 'forms', 'action' => 'index'));
		}
		
		$this->Question->recursive = -1;
		$question = $this->Question->read(null, $id);
		$newOrder = $question['Question']['order'] + $direction;
		
		// question count
		$params = array(
			'conditions' => array(
				'form_id' => $question['Question']['form_id']
			)
		);
		$questionCount = $this->Question->find('count', $params) - 1;
		
		if($newOrder < 0 || $newOrder > $questionCount) {
			$this->Session->setFlash('Ung?ltiger Aufruf');
			$this->redirect(array('controller' => 'forms', 'action' => 'view', $question['Question']['form_id']));
		}
		
		$this->Question->updateAll(
			array('Question.order' => $question['Question']['order']),
			array('Question.order' => $newOrder, 'Question.form_id' => $question['Question']['form_id'])
		);

		$this->Question->saveField('order', $newOrder);
		$this->redirect(array('controller' => 'forms', 'action' => 'view', $question['Question']['form_id']));
	}
}

