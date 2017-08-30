<div class="actions">
    <?php
    echo $this->Html->link(
        $this->Html->image("admin/add.gif") . 'Neuen Report anfordern',
        array('action' => 'add'),
        array('escape' => false)
    );
    ?>
</div>
<div class="reports index">
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th>Gesendet</th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
	</tr>
	<?php
	foreach ($reports as $report): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($report['User']['username'], array('controller' => 'users', 'action' => 'view', $report['User']['id'])); ?>
		</td>
		<td><?php echo $report['Report']['sended'] ? 'ja' : 'nein'; ?>&nbsp;</td>
		<td><?php echo $this->Time->niceShort($report['Report']['created']); ?>&nbsp;</td>

	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Seite {:page} von {:pages}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('zurück'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('weiter') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>

