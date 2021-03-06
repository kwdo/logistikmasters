<div class="formsUsers index">
	<h2><?php echo __('Forms Users'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('form_id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('next_question'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('mail'); ?></th>
			<th><?php echo $this->Paginator->sort('points'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($formsUsers as $formsUser): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($formsUser['Form']['title'], array('controller' => 'forms', 'action' => 'view', $formsUser['Form']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($formsUser['User']['id'], array('controller' => 'users', 'action' => 'view', $formsUser['User']['id'])); ?>
		</td>
		<td><?php echo h($formsUser['FormsUser']['next_question']); ?>&nbsp;</td>
		<td><?php echo h($formsUser['FormsUser']['modified']); ?>&nbsp;</td>
		<td><?php echo h($formsUser['FormsUser']['mail']); ?>&nbsp;</td>
		<td><?php echo h($formsUser['FormsUser']['points']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $formsUser['FormsUser']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $formsUser['FormsUser']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $formsUser['FormsUser']['id']), null, __('Are you sure you want to delete # %s?', $formsUser['FormsUser']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Forms User'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Forms'), array('controller' => 'forms', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Form'), array('controller' => 'forms', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
