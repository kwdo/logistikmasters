<div class="settings form">
    <?php echo $this->Form->create(); ?>
    <fieldset>
        <legend><?php echo __('Testmail versenden'); ?></legend>
        <?php
        echo $this->Form->input('competion_end', array(
            'type' => 'text',
            'label' => 'E-Mail'
        ));

        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Senden')); ?>
</div>