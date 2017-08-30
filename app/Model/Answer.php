<?php
class Answer extends AppModel
{
	public $belongsTo = 'Question';
	public $displayField = 'answer';
	
	public function beforeSave() {
		$this->data['Answer']['answer'] = str_replace(array('<p>', '</p>'), '', $this->data['Answer']['answer']);
		return true;
	}
}
