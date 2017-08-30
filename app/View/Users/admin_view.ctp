<?php
App::import('Sanitize');
?>
<h3><?php echo $user['UserProfile']['firstname'].' '.$user['UserProfile']['surname']; ?></h3>
<dl>
    <dt><?php echo __('User'); ?></dt>
    <dd>
        <?php echo $this->Html->link($user['User']['username'], array('controller' => 'users', 'action' => 'edit', $user['User']['id'])); ?>
        &nbsp;
    </dd>
     <dt>Vorname</dt>
    <dd>
        <?php echo h($user['UserProfile']['firstname']); ?>
        &nbsp;
    </dd>
    <dt>Nachname</dt>
    <dd>
        <?php echo h($user['UserProfile']['surname']); ?>
        &nbsp;
    </dd>
    <dt>Straße</dt>
    <dd>
        <?php echo h($user['UserProfile']['street']); ?>
        &nbsp;
    </dd>
    <dt>PLZ</dt>
    <dd>
        <?php echo h($user['UserProfile']['zip']); ?>
        &nbsp;
    </dd>
    <dt>Ort</dt>
    <dd>
        <?php echo h($user['UserProfile']['city']); ?>
        &nbsp;
    </dd>
    <dt>Telefon</dt>
    <dd>
        <?php echo h($user['UserProfile']['phone']); ?>
        &nbsp;
    </dd>
    <dt>Ort der Hochschule</dt>
    <dd>
        <?php echo $user['UserProfile']['SchoolCity']['name']; ?>
        &nbsp;
    </dd>
    <dt>Hochschule</dt>
    <dd>
        <?php echo $user['UserProfile']['School']['name']; ?>
        &nbsp;
    </dd>
    <dt>Hochschulart</dt>
    <dd>
        <?php echo h($user['UserProfile']['company']); ?>
        &nbsp;
    </dd>
    <dt>Fachrichtung</dt>
    <dd>
        <?php echo h($user['UserProfile']['company_city']); ?>
        &nbsp;
    </dd>
    <dt>Vorname Professor</dt>
    <dd>
        <?php echo h($user['UserProfile']['trainer_firstname']); ?>
        &nbsp;
    </dd>
    <dt>Nachname Professor</dt>
    <dd>
        <?php echo h($user['UserProfile']['trainer_surname']); ?>
        &nbsp;
    </dd>
    <dt>Angestrebter Abschluss</dt>
    <dd>
        <?php
            if($user['UserProfile']['degree'] == 'nicht in Liste')
            {
                echo $user['UserProfile']['degree_name'];
            }
            else
            {
                echo $user['UserProfile']['degree'];
            }
        ?>
        &nbsp;
    </dd>
    <dt>Registriert</dt>
    <dd><?php echo $user['User']['created']; ?></dd>
    <dt>Zuletzt eingeloggt</dt>
    <dd><?php echo $user['User']['lastlogin'] ? $user['User']['lastlogin'] : 'Nie'; ?></dd>
</dl>

<h3>PDF</h3>
<?php if($user['UserProfile']['certificate']): ?>
                 Liegt vor
            <?php elseif(isset($user['UserProfile']['fileupload'])): ?>
            <?php echo $this->Html->link('Download', DS . 'files' . DS . 'user_profile' .  DS . 'fileupload' . DS . $user['UserProfile']['id'] . DS . $user['UserProfile']['fileupload'],array('target' =>'_blank')); ?>
            <?php endif; ?>

<h3>Fragebögen</h3>
<table cellpadding="0" cellspacing="0">
    <tr>
        <th>Fragebogen</th>
        <th>Fortschritt</th>
        <th>Letzte Aktivität</th>
        <th>Punkte</th>
        <th class="actions">Aktionen</th>
    </tr>
    <?php
    foreach($forms as $formId => $form):
        if(isset($form['FormsUser'])):
            if($form['FormsUser']['mail'] == 1):
                $text = 'Vom Admin eingetragen';
                $class = 'mail';
            elseif($form['FormsUser']['next_question'] == 0):
                $text = 'Abgeschlossen';
                $class = 'active';
            else:
                $text = 'Begonnen';
                $class = 'unactive';
            endif;
            $modified = $this->Time->format("d.m.Y", $form['FormsUser']['modified']);
            $image = 'edit';
            $points = $form['FormsUser']['points'];
        else:
            $text = 'Nicht begonnen';
            $class = '';
            $modified = '';
            $image = 'add';
            $points = '';
        endif;
        ?>
        <tr>
            <td><?php echo $form['title']; ?></td>
            <?php echo '<td class="'.$class.'">'.$text.'</td>'; ?>
            <td><?php echo $modified; ?></td>
            <td><?php echo $points; ?></td>
            <td class="actions">
                <?php //if($image=='add'): ?>
                <?php echo $this->Html->link($this->Html->image('admin/'.$image.'.gif'), array('controller' => 'forms', 'action'=>'user_edit', $formId, $user['User']['id']) ,array('escape' => false)); ?>
                <?php //endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
</table>

