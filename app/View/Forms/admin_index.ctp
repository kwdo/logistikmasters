<div class="actions">
	<?php echo $this->Html->link(
                       $this->Html->image('admin/add.gif') . "Neuen Fragebogen anlegen",
                        array('action' => 'add'),
                        array('escape' => false)
                    );
    ?>
</div>

<p>
<?php
echo $this->Paginator->counter(array(
'format' => 'Seite %page% von %pages%, zeige %current% Einträge von %count%, starte ab Eintrag %start%, ende bei %end%'
));
?></p>

<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $this->Paginator->sort('Titel', 'title');?></th>
	<th><?php echo $this->Paginator->sort('online_date');?></th>
	<th class="actions">Aktionen</th>
</tr>
<?php foreach ($forms as $formData): ?>
	<tr>
		<td><?php echo $this->Html->link('Fragebogen '.$formData['Form']['title'], array('action'=>'view', $formData['Form']['id'])); ?></td>
		<td><?php echo $this->Time->format('d.m.Y', $formData['Form']['online_date']); ?></td>
		<td class="actions">
            <?php echo $this->Html->link(
            $this->Html->image('admin/edit.gif'),
            array('action'=>'view', $formData['Form']['id']),
            array('escape' => false)
        );
            ?>
            <?php echo $this->Form->postLink(
            $this->Html->image('admin/trash.gif', array('alt' => __('Löschen'))),
            array('action' => 'delete', $formData['Form']['id']),
            array('escape' => false),
            __("Möchten Sie den Fragebogen #%s wirklich löschen?", $formData['Form']['title'])
        ); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>

<div class="paging">
	<?php echo $this->Paginator->prev('<< zurück', array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $this->Paginator->numbers();?>
	<?php echo $this->Paginator->next('weiter >>', array(), null, array('class'=>'disabled'));?>
</div>

