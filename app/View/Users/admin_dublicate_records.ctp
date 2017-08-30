<?php
App::uses('Sanitize', 'Utility');
$this->Paginator->options(array('url' => array('year_id' => $year_id)));
$entryNr =$this->Paginator->counter('{:start}');
?>
<div class="subTabs">
    <?php
    for($i=1; $i<=CURRENT_YEAR_ID; $i++):
        $class = ($i == $year_id) ? 'active' : '';
        echo $this->Html->link(2012+$i, array('action' => 'duplicate_records', $i), array('class' => $class));
    endfor;
    ?>
    <div style="clear:left;"></div>
</div>
<div class="actions">
    <?php
    echo $this->Html->link(
        $this->Html->image("admin/reload.gif") . 'Punkte berechnen',
        array('action' => 'calc_points'),
        array('escape' => false)
    );
    ?>

    <?php
    echo $this->Html->link(
        $this->Html->image("admin/user.gif") . 'Daten auswerten',
        array('action' => 'report_form'),
        array('escape' => false)
    );
    ?>

    <?php
    echo $this->Html->link(
        $this->Html->image("admin/add.gif") . 'Benutzer anlegen',
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
        <th>&nbsp;</th>
        <th><?php echo $this->Paginator->sort('doubleoptin','Aktiviert'); ?></th>
        <th><?php echo $this->Paginator->sort('UserProfile.surname','Nachname');?></th>
        <th><?php echo $this->Paginator->sort('UserProfile.firstname','Vorname');?></th>
        <th><?php echo $this->Paginator->sort('User.email','Email-Adresse');?></th>
        <th><?php echo $this->Paginator->sort('UserProfile.fileupload','Immat.besch.');?></th>
        <th><?php echo $this->Paginator->sort('UserPoint.points','Punkte');?></th>
        <th><?php echo $this->Paginator->sort('UserPoint.finished','Fragebögen');?></th>
        <th>Aktionen</th>
    </tr>
    <?php foreach($users as $user): ?>
    <tr>
        <td><?php echo $entryNr ?></td>
        <td><?php echo $user['User']['doubleoptin'] ? 'JA' : 'NEIN'; ?>&nbsp;</td>
        <td><?php echo $this->Html->link($user['UserProfile']['surname'], array('action' => 'view', $user['User']['id'])) ?></td>
        <td><?php echo Sanitize::html($user['UserProfile']['firstname']) ?></td>
        <td><?php echo Sanitize::html($user['User']['email']) ?></td>
        <td>
            <?php if($user['UserProfile']['certificate']): ?>
            Liegt vor
            <?php elseif(isset($user['UserProfile']['fileupload'])): ?>
            <?php echo $this->Html->link('Download', DS . 'files' . DS . 'user_profile' .  DS . 'fileupload' . DS . $user['UserProfile']['id'] . DS . $user['UserProfile']['fileupload'],array('target' =>'_blank')); ?>
            <?php endif; ?>
        </td>
        <td><?php echo $user['UserPoint']['points'] ?></td>
        <td><?php echo $user['UserPoint']['finished'] ?></td>
        <td class="actions">
            <?php echo $this->Html->link($this->Html->image('admin/user.gif'), array('action' => 'view', $user['User']['id']),array('escape' => false)); ?>
            <?php
            $singleEditArray = $editArray;
            $singleEditArray[] = $user['User']['id'];
            ?>
            <?php echo $this->Html->link($this->Html->image('admin/edit.gif'),$singleEditArray,array('escape' => false)); ?>
            <?php echo $this->Form->postLink(
            $this->Html->image('admin/trash.gif', array('alt' => __('Löschen'))),
            array('action' => 'delete', $user['User']['id']),
            array('escape' => false),
            __("Möchten Sie den user #%s wirklich löschen?", $user['UserProfile']['surname'])
        ); ?>




        </td>
    </tr>
    <?php $entryNr++; ?>
    <?php endforeach; ?>
</table>

<div class="paging">
    <?php echo $this->Paginator->prev('<< zurück', array(), null, array('class'=>'disabled'));?>
    | 	<?php echo $this->Paginator->numbers();?>
    <?php echo $this->Paginator->next('weiter >>', array(), null, array('class'=>'disabled'));?>
</div>

<?php
echo $this->Form->create('User', array('action' => 'index'));
echo $this->Form->input('UserProfile.surname', array('label' => 'Nachname', 'type' => 'text'));
echo $this->Form->end('Suchen');
?>


