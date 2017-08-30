<div class="actions">
    <?php
    echo $this->Html->link(
        $this->Html->image("admin/add.gif") . 'Ort anlegen',
        array('action' => 'add'),
        array('escape' => false)
    );
    ?>
</div>
<div class="schoolCities index">
	<table cellpadding="0" cellspacing="0">
	<tr>

			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($schoolCities as $schoolCity): ?>
	<tr <?php if($schoolCity['SchoolCity']['notchecked']): ?>class="notchecked"<?php endif; ?>>
		<td><?php echo $this->Html->link(h($schoolCity['SchoolCity']['name']), array('action' => 'view', $schoolCity['SchoolCity']['id']),array('escape' => false)); ?>&nbsp;</td>
		<td class="actions">
            <?php echo $this->Html->link($this->Html->image('admin/user.gif'), array('action' => 'view', $schoolCity['SchoolCity']['id']),array('escape' => false)); ?>
            <?php echo $this->Html->link($this->Html->image('admin/edit.gif'), array('action' => 'edit', $schoolCity['SchoolCity']['id']),array('escape' => false)); ?>
            <?php echo $this->Form->postLink(
            $this->Html->image('admin/trash.gif', array('alt' => __('Löschen'))),
            array('action' => 'delete', $schoolCity['SchoolCity']['id']),
            array('escape' => false),
            __("Möchten Sie #%s wirklich löschen?", $schoolCity['SchoolCity']['name'])
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

