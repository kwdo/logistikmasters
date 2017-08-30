<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('username');
		echo $this->Form->input('email');
		echo $this->Form->input('status');
		echo $this->Form->input('datenschutz');
		echo $this->Form->input('password');
		echo $this->Form->input('doubleoptin_hash');
		echo $this->Form->input('doubleoptin');
		echo $this->Form->input('Form');
		echo $this->Form->input('Question');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('User.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Profiles'), array('controller' => 'profiles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Profile'), array('controller' => 'profiles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Catalogs'), array('controller' => 'user_catalogs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Catalog'), array('controller' => 'user_catalogs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Catalogs2011s'), array('controller' => 'user_catalogs2011s', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Catalogs2011'), array('controller' => 'user_catalogs2011s', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Catalogs Olds'), array('controller' => 'user_catalogs_olds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Catalogs Old'), array('controller' => 'user_catalogs_olds', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Catalogs Tmps'), array('controller' => 'user_catalogs_tmps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Catalogs Tmp'), array('controller' => 'user_catalogs_tmps', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Points'), array('controller' => 'user_points', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Point'), array('controller' => 'user_points', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Forms'), array('controller' => 'forms', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Form'), array('controller' => 'forms', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
	</ul>
</div>
