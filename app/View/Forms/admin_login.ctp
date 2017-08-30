<?php echo $this->Form->create(null, array('action' => 'login')); ?>
	<fieldset>
 		<legend>Authentifizierung erforderlich</legend>
	<?php
		echo $this->Form->input('username', array('label' => 'Benutzername'));
		echo $this->Form->input('password', array('label' => 'Kennwort'));
	?>
	</fieldset>
<?php echo $this->Form->end('Einloggen');?>