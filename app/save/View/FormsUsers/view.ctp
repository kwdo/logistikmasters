<div class="formsUsers view">
<h2><?php  echo __('Forms User'); ?></h2>
	<dl>
		<dt><?php echo __('Form'); ?></dt>
		<dd>
			<?php echo $this->Html->link($formsUser['Form']['title'], array('controller' => 'forms', 'action' => 'view', $formsUser['Form']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($formsUser['User']['id'], array('controller' => 'users', 'action' => 'view', $formsUser['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Next Question'); ?></dt>
		<dd>
			<?php echo h($formsUser['FormsUser']['next_question']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($formsUser['FormsUser']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mail'); ?></dt>
		<dd>
			<?php echo h($formsUser['FormsUser']['mail']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Points'); ?></dt>
		<dd>
			<?php echo h($formsUser['FormsUser']['points']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Forms User'), array('action' => 'edit', $formsUser['FormsUser']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Forms User'), array('action' => 'delete', $formsUser['FormsUser']['id']), null, __('Are you sure you want to delete # %s?', $formsUser['FormsUser']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Forms Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Forms User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Forms'), array('controller' => 'forms', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Form'), array('controller' => 'forms', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
