<div class="schools form">
<?php echo $this->Form->create('School'); ?>
	<fieldset>
		<legend><?php echo __('Hochschule hinzufügen'); ?></legend>
	<?php
		echo $this->Form->input('school_city_id',array('label'=>'Ort'));
		echo $this->Form->input('name');

	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
