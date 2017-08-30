<?php echo $this->Form->create('Form', array('type' => 'file'));?>
	<fieldset>
 		<legend>Fragebogentitel bearbeiten</legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title', array('label' => 'Titel'));
		echo $this->Form->input('online_date', array('dateFormat' => 'DMY'));
		echo $this->Form->input('file', array('type' => 'file', 'label' => 'PDF'));
		echo (isset($this->request->data['Form']['file']) && $this->request->data['Form']['file']) ? $this->Html->link($this->request->data['Form']['file'],
			'/files/uploads/form-'.$this->request->data['Form']['id'].'-'.$this->request->data['Form']['file']) : '';
	?>
	</fieldset>
<?php echo $this->Form->end('Speichern');?>
