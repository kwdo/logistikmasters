<div class="formsUsers form">
<?php echo $this->Form->create('FormsUser'); ?>
	<fieldset>
		<legend><?php echo __('Add Forms User'); ?></legend>
	<?php
		echo $this->Form->input('form_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('next_question');
		echo $this->Form->input('mail');
		echo $this->Form->input('points');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Forms Users'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Forms'), array('controller' => 'forms', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Form'), array('controller' => 'forms', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
