<div class="reports form">
<?php echo $this->Form->create('Report'); ?>
	<fieldset>
		<legend><?php echo __('Excel Report'); ?></legend>
	<?php
		echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$user_id));
        echo $this->Form->input('sended',array('type'=>'hidden','value'=>0));

	?>
        <?php echo $this->Form->end(__('Excel Report anfordern')); ?>
	</fieldset>

</div>

