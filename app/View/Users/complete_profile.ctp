<?php echo $this->Html->script('users_add', array('block' => 'scriptBottom')); ?>
<div class="users form">
    <h1>Profil vervollständigen</h1>
    <p>Nur noch ein Schritt bevor Sie starten können!</p>
    <p>Bitte ergänzen Sie folgende Angabe:</p>
     <?php echo $this->Session->flash(); ?>
    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <h5> Daten zum Studium:</h5>
        <?php
        $degree = array('Master'         => 'Master',
            'Bachelor'       => 'Bachelor',
            'nicht in Liste' => 'nicht in Liste'
        );
        echo $this->Form->input('UserProfile.degree', array('options' => $degree,'label' => 'Angestrebter Abschluss','empty' => 'Bitte wählen'));
        ?>
        <div id="UserProfileDegreeSection">
            <?php
            echo $this->Form->input('UserProfile.degree_name', array('label' => 'Angestrebter Abschluss'));
            ?>
        </div>
    </fieldset>
    <p class="font-size: 11px"><sup style="color: #EE3322;">*</sup> Pflichtfeld</p>
    <?php echo $this->Form->end(__('Speichern')); ?>
    <div class="clear"></div>
</div>