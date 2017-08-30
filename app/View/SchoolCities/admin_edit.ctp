<div class="schoolCities form">
<?php echo $this->Form->create('SchoolCity'); ?>
	<fieldset>
		<legend><?php echo __('Ort bearbeiten'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('notchecked',array('label' => 'Nicht überprüft'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Speichern')); ?>
</div>

