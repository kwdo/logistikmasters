<div class="actions">
<?php
echo $this->Html->link(
    $this->Html->image("admin/add.gif") . 'Hochschule anlegen',
    array('action' => 'add'),
    array('escape' => false)
);
?>
</div>
<div class="schools index">
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('SchoolCity.name','Stadt'); ?></th>
			<th><?php echo $this->Paginator->sort('name','Hochschule'); ?></th>
            <th><?php echo $this->Paginator->sort('user_profile_count','Aktivierte Studenten'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($schools as $school): ?>
	<tr <?php if($school['School']['notchecked']): ?>class="notchecked"<?php endif; ?>>
		<td>
			<?php echo $this->Html->link($school['SchoolCity']['name'], array('controller' => 'school_cities', 'action' => 'view', $school['SchoolCity']['id'])); ?>
		</td>
		<td> <?php echo $this->Html->link(h($school['School']['name']), array('action' => 'view', $school['School']['id']),array('escape' => false)); ?>&nbsp;</td>
        <td><?php echo $school['School']['user_profile_count'] ?></td>
		<td class="actions">
            <?php echo $this->Html->link($this->Html->image('admin/user.gif'), array('action' => 'view', $school['School']['id']),array('escape' => false)); ?>
            <?php echo $this->Html->link($this->Html->image('admin/edit.gif'), array('action' => 'edit', $school['School']['id']),array('escape' => false)); ?>
            <?php echo $this->Form->postLink(
            $this->Html->image('admin/trash.gif', array('alt' => __('Löschen'))),
            array('action' => 'delete', $school['School']['id']),
            array('escape' => false),
            __("Möchten Sie #%s wirklich löschen?", $school['School']['name'])
        ); ?>
        </td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
        'format' => __('Seite {:page} von {:pages}, Zeige {:current} Einträge von {:count} gesamt, Startet bei {:start}, Endet bei {:end}')
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