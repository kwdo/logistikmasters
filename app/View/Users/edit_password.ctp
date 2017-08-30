<?php echo $this->Html->script('users_add', array('block' => 'scriptBottom')); ?>
<div class="users form">
	<h1>Passwort ändern</h1>
	<?php echo $this->Session->flash(); ?>

	<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<h5>Passwort ändern</h5>
		<?php
			echo $this->Form->input('User.id');
			echo $this->Form->input('password', array('label' => 'Neues Passwort'));
			echo $this->Form->input('password_repeat', array('label' => 'Neues Passwort wiederholen', 'type' => 'password'));
		?>
	</fieldset>
	<?php echo $this->Form->end(__('Ändern')); ?>
	<div class="clear"></div>
</div>