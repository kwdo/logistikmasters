<div class="years form">
<?php echo $this->Form->create('Year'); ?>
	<fieldset>
		<legend><?php echo __('Jahr hinzufügen'); ?></legend>
        <p>Achtung, dieser Vorgang dauert <b>SEHR</b> lange (ca. 3min). Bitte brechen Sie ihn nicht ab. Es werden alle eingesandten Bescheinigungen gelöscht. Das neue Jahr wird angelegt und die Aktivierung aller User entfernt.</p>
	<?php
		echo $this->Form->input('title');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Speichern')); ?>
</div>

