<div class="users form">
    <?php echo $this->Form->create('Friend', array('action' => 'send')); ?>
<fieldset>
    <h5>Freunde empfehlen</h5>
    <?php
    echo $this->Form->input('Friend.email', array('label' => 'E-Mail Ihres Freundes'));
    echo $this->Form->input('Friend.message', array('label' => 'Text','cols' => 50, 'rows' => 10));
    ?>
</fieldset>
<?php echo $this->Form->end(__('Senden')); ?>
<div class="clear"></div>
</div>