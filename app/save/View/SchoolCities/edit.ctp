<div class="schoolCities form">
<?php echo $this->Form->create('SchoolCity'); ?>
	<fieldset>
		<legend><?php echo __('Edit School City'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('sorting');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('SchoolCity.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('SchoolCity.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List School Cities'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Schools'), array('controller' => 'schools', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New School'), array('controller' => 'schools', 'action' => 'add')); ?> </li>
	</ul>
</div>
