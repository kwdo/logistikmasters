<div class="profiles form">
<?php echo $this->Form->create('UserProfile'); ?>
	<fieldset>
		<legend><?php echo __('Add Profile'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('sex');
		echo $this->Form->input('firstname');
		echo $this->Form->input('surname');
		echo $this->Form->input('street');
		echo $this->Form->input('zip');
		echo $this->Form->input('city');
		echo $this->Form->input('phone');
		echo $this->Form->input('school_id');
		echo $this->Form->input('company');
		echo $this->Form->input('company_city');
		echo $this->Form->input('trainer_firstname');
		echo $this->Form->input('trainer_surname');
		echo $this->Form->input('year_of_apprenticeship');
		echo $this->Form->input('career_aspiration');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Profiles'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Schools'), array('controller' => 'schools', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New School'), array('controller' => 'schools', 'action' => 'add')); ?> </li>
	</ul>
</div>
