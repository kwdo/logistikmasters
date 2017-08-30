<div class="schoolCities view">
<h2><?php  echo __('Ort'); ?></h2>
	<dl>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($schoolCity['SchoolCity']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="cake-actions">
	<h3><?php echo __('Aktionen'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Ort bearbeiten'), array('action' => 'edit', $schoolCity['SchoolCity']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Ort löschen'), array('action' => 'delete', $schoolCity['SchoolCity']['id']), null, __('Are you sure you want to delete # %s?', $schoolCity['SchoolCity']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Zur Übersicht'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Neuer Ort'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Übersicht Hochschulen'), array('controller' => 'schools', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Neue Hochschule anlegen'), array('controller' => 'schools', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Verbundene Hochschulen'); ?></h3>
	<?php if (!empty($schoolCity['School'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Hochschule'); ?></th>
		<th class="actions"><?php echo __('Aktionen'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($schoolCity['School'] as $school): ?>
		<tr>
			<td><?php echo $school['name']; ?></td>
            <td class="actions">
                <?php echo $this->Html->link($this->Html->image('admin/user.gif'), array('controller' => 'schools','action' => 'view', $school['id']),array('escape' => false)); ?>
                <?php echo $this->Html->link($this->Html->image('admin/edit.gif'), array('controller' => 'schools','action' => 'edit', $school['id']),array('escape' => false)); ?>
                <?php echo $this->Form->postLink(
                $this->Html->image('admin/trash.gif', array('alt' => __('Löschen'))),
                array('controller' => 'schools','action' => 'delete', $school['id']),
                array('escape' => false),
                __("Möchten Sie #%s wirklich löschen?", $school['name'])
            ); ?>
            </td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
