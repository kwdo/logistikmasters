<div class="users index">
	<h2><?php echo __('Users'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('username'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('datenschutz'); ?></th>
			<th><?php echo $this->Paginator->sort('password'); ?></th>
			<th><?php echo $this->Paginator->sort('doubleoptin_hash'); ?></th>
			<th><?php echo $this->Paginator->sort('doubleoptin'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($users as $user): ?>
	<tr>
		<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['status']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['datenschutz']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['password']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['doubleoptin_hash']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['doubleoptin']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?></li>
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
