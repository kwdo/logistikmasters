
<div class="actions">
    <?php echo $this->Html->link(
        $this->Html->image('admin/arrow1_w.gif') . "Zurück zum Benutzer",
        array('controller' => 'users', 'action' => 'view', $this->request->data['User']['userID']),
        array('escape' => false)
    );
    ?>
</div>
<h3><?php echo 'Fragebogen '.$this->request->data['Form']['title']; ?></h3>
<?php
	echo $this->Form->create('Form', array('action' => 'user_edit'));
	
	echo $this->Form->hidden('Form.id');
	echo $this->Form->hidden('User.userID');
	echo $this->Form->hidden('Form.new', array('value' => (int)!isset($this->request->data['Question'][0]['User'][0]['QuestionsUser']['answer_id'])));

	foreach($this->request->data['Question'] as $question):
		echo '<fieldset><legend>Frage '.($question['order'] + 1).'</legend>';
		echo '<h4>'.$question['question'].'</h4>';
		
		$options = array();
		foreach($question['Answer'] as $answer) {
			$options[$answer['id']] = $answer['answer'];
		}
		$presel = isset($question['User'][0]['QuestionsUser']['answer_id']) ? $question['User'][0]['QuestionsUser']['answer_id'] : 0;
		echo $this->Form->input('Question.'.$question['id'].'.Answer.id', array('type' => 'radio', 'options' => $options, 'div' => 'formAnswers', 'value' => $presel, 'separator' => '<br /><br />'));

		echo '</fieldset>';
	endforeach;

	echo $this->Form->end('Speichern');
?>