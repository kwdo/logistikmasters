<?php

// echo titles
	addEncodedField('Geschlecht', $isLatin1, $this);
	addEncodedField('Vorname', $isLatin1, $this);
	addEncodedField('Nachname', $isLatin1, $this);
	addEncodedField('E-Mail', $isLatin1, $this);
	addEncodedField('Opt-In-Hash', $isLatin1, $this);
	$this->csv->endRow();

	foreach ($users as $user)
	{
		addEncodedField($user['UserProfile']['gender'], $isLatin1, $this);
		addEncodedField($user['UserProfile']['firstname'], $isLatin1, $this);
		addEncodedField($user['UserProfile']['surname'], $isLatin1, $this);
		addEncodedField($user['User']['email'], $isLatin1, $this);
		addEncodedField($user['User']['doubleoptin_hash'], $isLatin1, $this);
		$this->csv->endRow();
	}

	echo $this->csv->render('Ohne_Rueckmeldung.csv');

	function addEncodedField($value, $isLatin1, $that)
	{
		if ($isLatin1)
		{
			$value = utf8_decode($value);
		}
		$that->csv->addField($value);
	}