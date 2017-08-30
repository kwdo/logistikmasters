<?php
class Question extends AppModel
{
	public $belongsTo = 'Form';
	public $displayField = 'question';
	public $hasMany = array(
		'Answer' => array(
			'dependent' => true
		)
	);
	public $hasAndBelongsToMany = array(
		'User' => array(
			'joinTable' => 'questions_users',
			'foreignKey' => 'question_id',
			'associationForeignKey' => 'user_id',
			'fields' => 'User.username'
		)
	);
	protected $fileCache = array();
	private $oldData;
	
	
	public function beforeSave() {
		$data = $this->data['Question'];

		if(isset($data['question'])) {
			if(isset($data['id'])) {
				$this->recursive = -1;
				$this->oldData = $this->findById($data['id']);
			}
		
			$this->prepareUpload($this->data['Question']['image'], 'img/uploads/', 'image');
			$this->prepareUpload($this->data['Question']['file'], 'files/uploads/', 'file');
			$this->prepareUpload($this->data['Question']['special_photo'], 'img/uploads/special-', 'special_photo');
	
			// remove paragraphs
			$this->data['Question']['question'] = str_replace(array('<p>', '</p>'), '', $this->data['Question']['question']);
		}
		return true;
	}
	
	public function afterSave($created) {
		foreach($this->fileCache as $file) {
			$destination = sprintf($file['destination'], $this->id);
			move_uploaded_file($file['path'], $destination);
			chmod($destination, 0777);
		}
		return true;
	}
	
	public function afterDelete() {
		$data = $this->data['Question'];
		
		if($data['image'])
			@unlink('img/uploads/'.$data['id'].'-'.$data['image']);
		if($data['file'])
			@unlink('files/uploads/'.$data['id'].'-'.$data['file']);
		if($data['special_photo'])
			@unlink('img/uploads/special-'.$data['id'].'-'.$data['special_photo']);
			
		return true;
	}
	
	protected function prepareUpload(&$file, $folder, $index) {
		if(is_array($file) && $file['error'] == UPLOAD_ERR_OK) {
			$this->fileCache[] = array(
				'path' => $file['tmp_name'],
				'destination' => $folder.'%s-'.$file['name']
			);
			if($this->oldData) {
				@unlink($folder.$this->oldData['Question']['id'].'-'.$this->oldData['Question'][$index]);
			}
			$file = $file['name'];
		} elseif(is_array($file)) {
			$file = $this->oldData ? $this->oldData['Question'][$index] : '';
		}
	}
	
	public function blockedQuestion($question) {
		if($question['Question']['type'] == 'bonus' || $question['Question']['type'] == 'video') {
			$online = strtotime($question['Question']['online_date']);
			$offline = strtotime($question['Question']['offline_date']) + DAY;
			return ($online > time() || $offline < time());
		}
		return false;
	}
	
	
}
