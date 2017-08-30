<?php

$options = array(
    'Alle, Rangordnung nach erreichter Punktzahl',
    'Anzahl der Teilnehmer einer Hochschule, die X-Fragebögen ausgefüllt haben',
    /*
    'Alle, die über &ge;X% richtig haben',
    'Alle, die &lt;X% erreicht haben',
    'Wer hat noch keine X-Fragebögen ausgefüllt',
    'Auswertung nach Hochschule',
    */
    'Alle, die sich noch nicht zurückgemeldet haben',
    'Alle, die die Bonusfrage ausgefüllt haben'
);

foreach ($bonus as $key => $value)
{
    $bonus[$key] = $this->Text->truncate(strip_tags(html_entity_decode($value)), 100, array('ellipsis' => '...', 'exact'    => true, 'html'     => false));
}


echo $this->Form->create('User', array('action' => 'report'));
echo $this->Form->input('Auswerten', array('type'      => 'radio', 'options'   => $options, 'separator' => '<br /><br />'));
echo $this->Form->input('formscount', array('label'     => 'Fragebögen X', 'maxLength' => 3, 'div'       => 'floatingInput'));
echo '<div class="clear"></div>';
echo $this->Form->input('question', array('label'   => 'Bonusfrage', 'options' => $bonus));
echo $this->Form->input('output_charset', array('label'   => 'Ausgabe-Zeichensatz', 'options' => array('utf8'   => 'UTF-8', 'latin1' => 'Latin-1 (Windows)'), 'default' => 'latin1'));
echo $this->Form->end('Los');
