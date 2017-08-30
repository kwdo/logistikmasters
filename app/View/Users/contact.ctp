<?php
$GLOBALS['title'] = 'Katalog - Logistik Masters';
?><div class="contactForm">
    <?php
    echo $this->Form->create('User', array('action'=>'contact/'.$user['User']['id'])); ?>
    <h1><?php echo strip_tags($user['UserProfile']['firstname'].' '.$user['UserProfile']['surname']) ?> kontaktieren</h1>
    <?php
    echo $this->Form->input('name', array('label'=>'Name'));
    echo $this->Form->input('firma', array('label'=>'Firma'));
    echo $this->Form->input('email', array('label'=>'E-Mail-Adresse'));
    echo $this->Form->input('text', array('label'=>'Nachricht', 'type'=>'textarea','rows' => '20', 'cols' => '90'));
    //echo $this->Captcha->input();
    echo $this->Html->link('zurück zur Übersicht', array('action'=>'index'), array('class'=>'boxLink abs'));
    echo $this->Form->end('Abschicken');
    ?>
</div>
