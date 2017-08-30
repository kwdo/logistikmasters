<div class="schools form">
<?php echo $this->Form->create('School'); ?>
	<fieldset>
		<legend><?php echo __('Hochschule bearbeiten'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('school_city_id');
		echo $this->Form->input('name');
		echo $this->Form->input('notchecked',array('label' => 'Nicht überprüft'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Speichern')); ?>
</div>
