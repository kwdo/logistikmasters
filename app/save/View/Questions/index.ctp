<div class="questions index">
	<h2><?php echo __('Questions'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('form_id'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('points'); ?></th>
			<th><?php echo $this->Paginator->sort('question'); ?></th>
			<th><?php echo $this->Paginator->sort('image'); ?></th>
			<th><?php echo $this->Paginator->sort('file'); ?></th>
			<th><?php echo $this->Paginator->sort('order'); ?></th>
			<th><?php echo $this->Paginator->sort('online_date'); ?></th>
			<th><?php echo $this->Paginator->sort('offline_date'); ?></th>
			<th><?php echo $this->Paginator->sort('special_photo'); ?></th>
			<th><?php echo $this->Paginator->sort('special_name'); ?></th>
			<th><?php echo $this->Paginator->sort('special_desc'); ?></th>
			<th><?php echo $this->Paginator->sort('video_before'); ?></th>
			<th><?php echo $this->Paginator->sort('video_after'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($questions as $question): ?>
	<tr>
		<td><?php echo h($question['Question']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($question['Form']['title'], array('controller' => 'forms', 'action' => 'view', $question['Form']['id'])); ?>
		</td>
		<td><?php echo h($question['Question']['type']); ?>&nbsp;</td>
		<td><?php echo h($question['Question']['points']); ?>&nbsp;</td>
		<td><?php echo h($question['Question']['question']); ?>&nbsp;</td>
		<td><?php echo h($question['Question']['image']); ?>&nbsp;</td>
		<td><?php echo h($question['Question']['file']); ?>&nbsp;</td>
		<td><?php echo h($question['Question']['order']); ?>&nbsp;</td>
		<td><?php echo h($question['Question']['online_date']); ?>&nbsp;</td>
		<td><?php echo h($question['Question']['offline_date']); ?>&nbsp;</td>
		<td><?php echo h($question['Question']['special_photo']); ?>&nbsp;</td>
		<td><?php echo h($question['Question']['special_name']); ?>&nbsp;</td>
		<td><?php echo h($question['Question']['special_desc']); ?>&nbsp;</td>
		<td><?php echo h($question['Question']['video_before']); ?>&nbsp;</td>
		<td><?php echo h($question['Question']['video_after']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $question['Question']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $question['Question']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $question['Question']['id']), null, __('Are you sure you want to delete # %s?', $question['Question']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Question'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Forms'), array('controller' => 'forms', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Form'), array('controller' => 'forms', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Answers'), array('controller' => 'answers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Answer'), array('controller' => 'answers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
