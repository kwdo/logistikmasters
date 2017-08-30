<?php

	// echo titles
	$this->Csv->addField('Frage');
	$this->Csv->addField('Antwort A');
	$this->Csv->addField(' ');
	$this->Csv->addField('Antwort B');
	$this->Csv->addField(' ');
	$this->Csv->addField('Antwort C');
	$this->Csv->addField(' ');
	$this->Csv->addField('Total');
	$this->Csv->endRow();

	foreach($questions as $key => $question):
		$this->Csv->addField(strip_tags(html_entity_decode($question['Question']['question'])));
		$total = 0;
		
		for($i=0; $i<ANSWER_NUMBER; $i++) {
			$answer = $data[$key * ANSWER_NUMBER + $i];
			$this->Csv->addField(strip_tags(html_entity_decode($answer['Answer']['answer'])));
			$this->Csv->addField($answer[0]['count']);
			$total += $answer[0]['count'];
		}
		$this->Csv->addField($total);
		$this->Csv->endRow();
	endforeach;

	echo $this->Csv->render('Frageboegen.csv');
