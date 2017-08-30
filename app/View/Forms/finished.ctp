<?php
$GLOBALS['title'] = utf8_decode('Fragebogen - ' . (IS_BEST_AZUBI ? 'Best Azubi' : 'Logistik Masters'));
?><strong class="blue">Vielen Dank für Ihre Teilnahme!</strong>
<br /><br />
<hr />
<?php
	echo $this->Html->link('zurück zur Übersicht', array('controller' => 'forms', 'action' => 'index'), array('class' => 'boxLink blue back', 'style' => 'float:left'));
?>