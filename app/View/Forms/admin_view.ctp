<h3><?php echo 'Fragebogen '.$formData['Form']['title']; ?></h3>
<dl>
	<dt>Online Date</dt>
	<dd><?php echo $formData['Form']['online_date']; ?>&nbsp;</dd>
	<dt>PDF</dt>
	<dd><?php echo (isset($formData['Form']['file']) && $formData['Form']['file']) ? $this->Html->link($formData['Form']['file'],
			'/files/uploads/form-'.$formData['Form']['id'].'-'.$formData['Form']['file']) : '&nbsp;';; ?></dd>
</dl>

<div class="actions">
	<?php
        echo $this->Html->link(
                        $this->Html->image('admin/edit.gif') . "Bearbeiten",
                        array('action' => 'edit', $formData['Form']['id']),
                        array('escape' => false)
                );
    echo $this->Form->postLink(
        $this->Html->image('admin/trash.gif'). "Löschen",
        array('action' => 'delete', $formData['Form']['id']),
        array('escape' => false),
        __("Möchten Sie den Fragebogen #%s wirklich löschen?", $formData['Form']['title'])
    );

       if(isset($formData['Question'][0]['id'])):
           echo $this->Html->link(
               $this->Html->image('admin/search.gif') . "Fragebogen testen",
               array('controller'=>'questions','action'=>'view',$formData['Question'][0]['id'],'admin'=>false),
               array('escape' => false,'target' => '_blank')
           );

        endif;
        echo $this->Html->link(
            $this->Html->image("admin/user.gif") . 'Daten auswerten',
            array('action' => 'report', $formData['Form']['id']),
            array('escape' => false,'target' => '_blank')
        );
    echo $this->Html->link(
        $this->Html->image("admin/user.gif") . 'Statistik',
        array('action' => 'view_statistics', $formData['Form']['id']),
        array('escape' => false)
    );
    ?>
</div>


<h3>Fragen</h3>
<?php if(!empty($formData['Question'])):?>
<table cellpadding = "0" cellspacing = "0">
<tr>
	<th colspan="2">Frage</th>
	<th>Typ</th>
	<th>Punkte</th>
	<th class="actions">Aktionen</th>
</tr>
<?php
	$length = count($formData['Question']) - 1;
	foreach ($formData['Question'] as $key => $question):
		if($key == 0) $visible1 = 'visibility:hidden';
		else $visible1 = '';
		if($key == $length) $visible2 = 'visibility:hidden';
		else $visible2 = '';
?>
	<tr>
		<td><?php echo $key + 1; ?>.</td>
		<td><?php echo $question['question'];?></td>
		<td><?php echo $GLOBALS['questionTypes'][$question['type']];?></td>
		<td><?php echo $question['points'];?></td>
		<td class="actions">
			<?php echo $this->Html->link($this->Html->image('admin/edit.gif'), array('controller' => 'questions', 'action' => 'edit', $question['id']),array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image('admin/trash.gif'), array('controller' => 'questions', 'action' => 'delete', $question['id']),array('escape' => false), 'Soll diese Frage wirklich gelöscht werden?'); ?>
			<?php echo $this->Html->link($this->Html->image('admin/arrow1_n.gif'), array('controller' => 'questions', 'action' => 'up', $question['id']), array('style' => $visible1,'escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image('admin/arrow1_s.gif'), array('controller' => 'questions', 'action' => 'down', $question['id']), array('style' => $visible2,'escape' => false)); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>

<div class="actions">
    <?php
    echo $this->Html->link(
        $this->Html->image("admin/add.gif") . 'Frage hinzufügen',
        array('controller' => 'questions', 'action' => 'add', $formData['Form']['id']),
        array('escape' => false)
       );
    ?>
</div>





