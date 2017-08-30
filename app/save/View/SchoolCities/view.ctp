<div class="schoolCities view">
<h2><?php  echo __('School City'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($schoolCity['SchoolCity']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($schoolCity['SchoolCity']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sorting'); ?></dt>
		<dd>
			<?php echo h($schoolCity['SchoolCity']['sorting']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit School City'), array('action' => 'edit', $schoolCity['SchoolCity']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete School City'), array('action' => 'delete', $schoolCity['SchoolCity']['id']), null, __('Are you sure you want to delete # %s?', $schoolCity['SchoolCity']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List School Cities'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New School City'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Schools'), array('controller' => 'schools', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New School'), array('controller' => 'schools', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Schools'); ?></h3>
	<?php if (!empty($schoolCity['School'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('School City Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Additional Name'); ?></th>
		<th><?php echo __('Sorting'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($schoolCity['School'] as $school): ?>
		<tr>
			<td><?php echo $school['id']; ?></td>
			<td><?php echo $school['school_city_id']; ?></td>
			<td><?php echo $school['name']; ?></td>
			<td><?php echo $school['additional_name']; ?></td>
			<td><?php echo $school['sorting']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'schools', 'action' => 'view', $school['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'schools', 'action' => 'edit', $school['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'schools', 'action' => 'delete', $school['id']), null, __('Are you sure you want to delete # %s?', $school['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New School'), array('controller' => 'schools', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
