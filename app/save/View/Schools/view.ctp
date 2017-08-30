<div class="schools view">
<h2><?php  echo __('School'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($school['School']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('School City'); ?></dt>
		<dd>
			<?php echo $this->Html->link($school['SchoolCity']['name'], array('controller' => 'school_cities', 'action' => 'view', $school['SchoolCity']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($school['School']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Additional Name'); ?></dt>
		<dd>
			<?php echo h($school['School']['additional_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sorting'); ?></dt>
		<dd>
			<?php echo h($school['School']['sorting']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit School'), array('action' => 'edit', $school['School']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete School'), array('action' => 'delete', $school['School']['id']), null, __('Are you sure you want to delete # %s?', $school['School']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Schools'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New School'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List School Cities'), array('controller' => 'school_cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New School City'), array('controller' => 'school_cities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Profiles'), array('controller' => 'profiles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Profile'), array('controller' => 'profiles', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Profiles'); ?></h3>
	<?php if (!empty($school['Profile'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Sex'); ?></th>
		<th><?php echo __('Firstname'); ?></th>
		<th><?php echo __('Surname'); ?></th>
		<th><?php echo __('Street'); ?></th>
		<th><?php echo __('Zip'); ?></th>
		<th><?php echo __('City'); ?></th>
		<th><?php echo __('Phone'); ?></th>
		<th><?php echo __('School Id'); ?></th>
		<th><?php echo __('Company'); ?></th>
		<th><?php echo __('Company City'); ?></th>
		<th><?php echo __('Trainer Firstname'); ?></th>
		<th><?php echo __('Trainer Surname'); ?></th>
		<th><?php echo __('Year Of Apprenticeship'); ?></th>
		<th><?php echo __('Career Aspiration'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($school['Profile'] as $profile): ?>
		<tr>
			<td><?php echo $profile['id']; ?></td>
			<td><?php echo $profile['user_id']; ?></td>
			<td><?php echo $profile['sex']; ?></td>
			<td><?php echo $profile['firstname']; ?></td>
			<td><?php echo $profile['surname']; ?></td>
			<td><?php echo $profile['street']; ?></td>
			<td><?php echo $profile['zip']; ?></td>
			<td><?php echo $profile['city']; ?></td>
			<td><?php echo $profile['phone']; ?></td>
			<td><?php echo $profile['school_id']; ?></td>
			<td><?php echo $profile['company']; ?></td>
			<td><?php echo $profile['company_city']; ?></td>
			<td><?php echo $profile['trainer_firstname']; ?></td>
			<td><?php echo $profile['trainer_surname']; ?></td>
			<td><?php echo $profile['year_of_apprenticeship']; ?></td>
			<td><?php echo $profile['career_aspiration']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'profiles', 'action' => 'view', $profile['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'profiles', 'action' => 'edit', $profile['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'profiles', 'action' => 'delete', $profile['id']), null, __('Are you sure you want to delete # %s?', $profile['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Profile'), array('controller' => 'profiles', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
