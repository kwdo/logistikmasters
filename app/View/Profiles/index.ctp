<div class="profiles index">
	<h2><?php echo __('Profiles'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('sex'); ?></th>
			<th><?php echo $this->Paginator->sort('firstname'); ?></th>
			<th><?php echo $this->Paginator->sort('surname'); ?></th>
			<th><?php echo $this->Paginator->sort('street'); ?></th>
			<th><?php echo $this->Paginator->sort('zip'); ?></th>
			<th><?php echo $this->Paginator->sort('city'); ?></th>
			<th><?php echo $this->Paginator->sort('phone'); ?></th>
			<th><?php echo $this->Paginator->sort('school_id'); ?></th>
			<th><?php echo $this->Paginator->sort('company'); ?></th>
			<th><?php echo $this->Paginator->sort('company_city'); ?></th>
			<th><?php echo $this->Paginator->sort('trainer_firstname'); ?></th>
			<th><?php echo $this->Paginator->sort('trainer_surname'); ?></th>
			<th><?php echo $this->Paginator->sort('year_of_apprenticeship'); ?></th>
			<th><?php echo $this->Paginator->sort('career_aspiration'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($profiles as $profile): ?>
	<tr>
		<td><?php echo h($profile['Profile']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($profile['User']['id'], array('controller' => 'users', 'action' => 'view', $profile['User']['id'])); ?>
		</td>
		<td><?php echo h($profile['Profile']['sex']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['firstname']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['surname']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['street']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['zip']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['city']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['phone']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($profile['School']['name'], array('controller' => 'schools', 'action' => 'view', $profile['School']['id'])); ?>
		</td>
		<td><?php echo h($profile['Profile']['company']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['company_city']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['trainer_firstname']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['trainer_surname']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['year_of_apprenticeship']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['career_aspiration']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $profile['Profile']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $profile['Profile']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $profile['Profile']['id']), null, __('Are you sure you want to delete # %s?', $profile['Profile']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Profile'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Schools'), array('controller' => 'schools', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New School'), array('controller' => 'schools', 'action' => 'add')); ?> </li>
	</ul>
</div>
