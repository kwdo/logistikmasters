<div class="schools index">
	<h2><?php echo __('Schools'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('school_city_id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('additional_name'); ?></th>
			<th><?php echo $this->Paginator->sort('sorting'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($schools as $school): ?>
	<tr>
		<td><?php echo h($school['School']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($school['SchoolCity']['name'], array('controller' => 'school_cities', 'action' => 'view', $school['SchoolCity']['id'])); ?>
		</td>
		<td><?php echo h($school['School']['name']); ?>&nbsp;</td>
		<td><?php echo h($school['School']['additional_name']); ?>&nbsp;</td>
		<td><?php echo h($school['School']['sorting']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $school['School']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $school['School']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $school['School']['id']), null, __('Are you sure you want to delete # %s?', $school['School']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New School'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List School Cities'), array('controller' => 'school_cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New School City'), array('controller' => 'school_cities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Profiles'), array('controller' => 'profiles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Profile'), array('controller' => 'profiles', 'action' => 'add')); ?> </li>
	</ul>
</div>
