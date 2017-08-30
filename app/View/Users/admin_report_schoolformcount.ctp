<?php

// echo titles
	addEncodedField('Schule', $isLatin1, $this);
	addEncodedField('Schüler', $isLatin1, $this);
	addEncodedField('Fragebögen', $isLatin1, $this);
	$this->csv->endRow();

	foreach ($schoolCount as $schoolId => $count)
	{
		addEncodedField($schools[$schoolId], $isLatin1, $this);
		addEncodedField($count, $isLatin1, $this);
		addEncodedField($formscount, $isLatin1, $this);
		$this->csv->endRow();
	}

	echo $this->csv->render('Schulen_Fragebogen.csv');

	function addEncodedField($value, $isLatin1, $that)
	{
		if ($isLatin1)
		{
			$value = utf8_decode($value);
		}
		$that->csv->addField($value);
	}