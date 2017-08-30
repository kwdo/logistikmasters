<div class="users form">
    <?php echo $this->Session->flash('auth'); ?>
    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend>Bitte gib Deine E-Mail-Adresse und Dein Passwort ein</legend>
        <?php
        echo $this->Form->input('email',array('label' => 'E-Mail-Adresse'));
        echo $this->Form->input('password',array('label' => 'Passwort'));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Login')); ?>
</div>
