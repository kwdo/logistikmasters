<div class="schools view">
<h2><?php  echo __('Hochschule'); ?></h2>
	<dl>
		<dt><?php echo __('Ort'); ?></dt>
		<dd>
			<?php echo $this->Html->link($school['SchoolCity']['name'], array('controller' => 'school_cities', 'action' => 'view', $school['SchoolCity']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($school['School']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="cake-actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Bearbeite Hochschule'), array('action' => 'edit', $school['School']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Lösche Hochschule'), array('action' => 'delete', $school['School']['id']), null, __('Bist Du sicher, dass Du # %s löschen möchtest?', $school['School']['name'])); ?> </li>
		<li><?php echo $this->Html->link(__('Zur Übersicht'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Neue Hochschule anlegen'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Übersicht der Orte'), array('controller' => 'school_cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Neuen Ort anlegen'), array('controller' => 'school_cities', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Verbundene Benutzer'); ?></h3>
	<?php if (!empty($school['UserProfile'])): ?>
        <?php $usr = 1; ?>

	<table cellpadding = "0" cellspacing = "0">
	<tr>
        <th>&nbsp;</th>
		<th><?php echo __('Vorname'); ?></th>
		<th><?php echo __('Nachname'); ?></th>
        <th><?php echo __('E-Mail'); ?></th>
		<th><?php echo __('Ort'); ?></th>
		<th class="actions"><?php echo __('Aktionen'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($school['UserProfile'] as $profile): ?>
		<tr>
            <td style="text-align: right;"><?php echo $usr ?>.</td>
            <td><?php echo $profile['firstname']; ?></td>
			<td><?php echo $profile['surname']; ?></td>
			<td><?php echo $profile['User']['email']; ?></td>
			<td><?php echo $profile['city']; ?></td>
            <td class="actions">
                <?php echo $this->Html->link($this->Html->image('admin/user.gif'), array('controller' => 'users','action' => 'view', $profile['User']['id']),array('escape' => false)); ?>
                <?php echo $this->Html->link($this->Html->image('admin/edit.gif'), array('controller' => 'users','action' => 'edit', $profile['User']['id']),array('escape' => false)); ?>
                <?php echo $this->Form->postLink(
                $this->Html->image('admin/trash.gif', array('alt' => __('Löschen'))),
                array('controller' => 'users','action' => 'delete', $profile['User']['id']),
                array('escape' => false),
                __("Möchten Sie #%s wirklich löschen?", $profile['surname'])
            ); ?>
            </td>
		</tr>
            <?php $usr++; ?>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
