<div class="schoolCities form">
<?php echo $this->Form->create('SchoolCity'); ?>
	<fieldset>
		<legend><?php echo __('Ort anlegen'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Speichern')); ?>
</div>
