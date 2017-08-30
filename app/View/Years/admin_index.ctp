<div class="actions">

    <?php
    echo $this->Html->link(
        $this->Html->image("admin/add.gif") . 'Neues Jahr anlegen',
        array('action' => 'add'),
        array('escape' => false)
    );
    ?>
</div>

<div class="years index">

	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th class="actions">&nbsp;</th>
	</tr>
	<?php
	foreach ($years as $year): ?>
	<tr>
		<td><?php echo h($year['Year']['title']); ?>&nbsp;</td>
		<td class="actions">
	    </td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
