<?php echo $this->Form->create('Form', array('type' => 'file'));?>
	<fieldset>
 		<legend>Fragebogen hinzufügen</legend>
	<?php
		echo $this->Form->input('title', array('label' => 'Titel'));
		echo $this->Form->input('online_date', array('dateFormat' => 'DMY'));
		echo $this->Form->input('file', array('type' => 'file', 'label' => 'PDF'));
	?>
	</fieldset>
<?php echo $this->Form->end('Speichern');?>

