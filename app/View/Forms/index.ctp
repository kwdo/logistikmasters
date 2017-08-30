<?php
	$GLOBALS['title'] = 'Fragebogen - Logistik Masters';
?>
<h1>Fragebögen</h1>
<?php
    echo $this->Html->image('http://www.verkehrsrundschau.de' . $GLOBALS['controlArticle']['register_upload']['systemurl'], array("style" => "margin-bottom: 10px;"));
	echo $GLOBALS['controlArticle']['questions_text'];
?>
<?php




/*

 texts may be changed in six

<?php if (time() > $enddate): ?>
	<p>Der Einsendeschluss für Logistik Masters 2013 ist am 18.08.2013 verstrichen.
		Eine Bearbeitung der Fragebögen ist nicht mehr möglich.
		Zur Überprüfung Ihrer Antworten können Sie die PDF-Ansicht nutzen.</p>
<?php else: ?>
	<p>Auf der &Uuml;bersichtsseite sehen Sie die verf&uuml;gbaren Frageb&ouml;gen und nach dem Log-In Ihren pers&ouml;nlichen
		Bearbeitungsstatus. Sie können die Beantwortung des Fragebogens jederzeit unterbrechen und zwischenspeichern.
		<strong>Der Fragebogen gilt erst als abgeschlossen, wenn Sie nach Beantwortung der letzten Fragebogen-Frage auf
			"abschlie&szlig;en" geklickt haben. Dann ist der Fragebogen auch nicht mehr editierbar.</strong>
	</p>
<?php endif; ?>
*/

?>
<?php if ($loggedIn && isset($points) && $show_points_in_profile): // Vorrübergehend deaktiviert! ?>
    <div class="points">Ihre erreichte Punktzahl im LOGISTIK MASTERS Wettbewerb <?php echo CURRENT_YEAR ?>: <b><?php echo $points ?></b></div>
<?php endif; ?>
<div class="spacertop formsContainer">
	<?php if (!$forms):
		echo '<p>Es sind noch keine verfügbaren Fragebögen online.</p>';
	endif;

		foreach ($forms as $form):
			if ($loggedIn) {
				if (!$form['User']) {
					$class = 'unstarted';
					$text  = 'NOCH NICHT BEGONNEN!';
				} else {
					$edited = $this->Time->format("d.m.Y", $form['User'][0]['FormsUser']['modified']);
					if ($form['User'][0]['FormsUser']['mail'] == 1) {
						$class = 'mail';
						$text  = 'Per Post eingegangen. (' . $edited . ')';
					} elseif ($form['User'][0]['FormsUser']['next_question'] == 0) {
						$class = 'finished';
						$text  = 'Abgeschlossen. (' . $edited . ')';
					} else {
						$class = 'started';
						$text  = 'Teilweise ausgefüllt. (' . $edited . ')';
					}

				}
			} else {
				$class = '';
			}

			echo '<p class="formsList ' . $class . '">';

			if ($loggedIn) {
				echo '<span>' . $text . '</span>';
			}

			echo $this->Html->link('Fragebogen ' . $form['Form']['title'],
				array('controller' => 'questions', 'action' => 'view', $form['Question']['id']), array('class' => 'first'));
			if ($loggedIn) {
				echo $this->Html->link(
					$this->Html->image("iconPrint.gif", array("alt" => "Print")),
					array('action' => 'print_view', $form['Form']['id']),
					array('escape' => false, 'target' => '_blank')
				);


				if ($form['Form']['file']):
					echo $this->Html->link(
						$this->Html->image("iconPdf.gif", array("alt" => "Download")),
						'/files/uploads/form-' . $form['Form']['id'] . '-' . $form['Form']['file'],
						array('escape' => false, 'target' => '_blank')
					);
				endif;
			}
			echo '</p>';
		endforeach;
	?>
</div>

<?php if ($loggedIn): ?>
	<h2 class="blue spacertop">Legende:</h2>
	<p class="formsList unstarted" style="background-color:transparent;">Noch nicht begonnen</p>
	<p class="formsList started">Teilweise ausgefüllt</p>
	<p class="formsList finished">Abgeschlossen und eingegangen</p>
<?php endif; ?>


	
	