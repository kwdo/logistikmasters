<div class="answers view">
<h2><?php  echo __('Answer'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($answer['Answer']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Question'); ?></dt>
		<dd>
			<?php echo $this->Html->link($answer['Question']['id'], array('controller' => 'questions', 'action' => 'view', $answer['Question']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Answer'); ?></dt>
		<dd>
			<?php echo h($answer['Answer']['answer']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Correct'); ?></dt>
		<dd>
			<?php echo h($answer['Answer']['correct']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Answer'), array('action' => 'edit', $answer['Answer']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Answer'), array('action' => 'delete', $answer['Answer']['id']), null, __('Are you sure you want to delete # %s?', $answer['Answer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Answers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Answer'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions Users'), array('controller' => 'questions_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Questions User'), array('controller' => 'questions_users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Questions Users'); ?></h3>
	<?php if (!empty($answer['QuestionsUser'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Question Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Answer Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($answer['QuestionsUser'] as $questionsUser): ?>
		<tr>
			<td><?php echo $questionsUser['question_id']; ?></td>
			<td><?php echo $questionsUser['user_id']; ?></td>
			<td><?php echo $questionsUser['answer_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'questions_users', 'action' => 'view', $questionsUser['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'questions_users', 'action' => 'edit', $questionsUser['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'questions_users', 'action' => 'delete', $questionsUser['id']), null, __('Are you sure you want to delete # %s?', $questionsUser['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Questions User'), array('controller' => 'questions_users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
