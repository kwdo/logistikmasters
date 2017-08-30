<div class="questionsUsers view">
<h2><?php  echo __('Questions User'); ?></h2>
	<dl>
		<dt><?php echo __('Question'); ?></dt>
		<dd>
			<?php echo $this->Html->link($questionsUser['Question']['id'], array('controller' => 'questions', 'action' => 'view', $questionsUser['Question']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($questionsUser['User']['id'], array('controller' => 'users', 'action' => 'view', $questionsUser['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Answer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($questionsUser['Answer']['id'], array('controller' => 'answers', 'action' => 'view', $questionsUser['Answer']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Questions User'), array('action' => 'edit', $questionsUser['QuestionsUser']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Questions User'), array('action' => 'delete', $questionsUser['QuestionsUser']['id']), null, __('Are you sure you want to delete # %s?', $questionsUser['QuestionsUser']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Questions User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Answers'), array('controller' => 'answers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Answer'), array('controller' => 'answers', 'action' => 'add')); ?> </li>
	</ul>
</div>
