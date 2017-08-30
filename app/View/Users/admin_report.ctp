<?php

// echo titles
$this->csv->addField('USERID');
$this->csv->addField('Vorname');
$this->csv->addField('Nachname');
$this->csv->addField('Strasse');
$this->csv->addField('PLZ');
$this->csv->addField('Ort');
$this->csv->addField('Tel');
$this->csv->addField('Hochschule');
$this->csv->addField('Ort Hochschule');
$this->csv->addField('Hochschulart');
$this->csv->addField('Fachrichtung');
$this->csv->addField('Vorname Professor / Studienleiter');
$this->csv->addField('Nachname Professor / Studienleiter');
$this->csv->addField('Immatrikulationsbescheinigung erhalten?');
$this->csv->addField('E-Mail');
$this->csv->addField('Punkte');
$this->csv->addField('Fragebögen');
$this->csv->addField('TLS');
$this->csv->addField('Angestrebter Abschluss');
$this->csv->endRow();


foreach ($users as $user)
{
    if(empty($user['UserProfile']['degree'])){
        $degree = '';
    }elseif($user['UserProfile']['degree'] == 'Master' || $user['UserProfile']['degree']== 'Bachelor'){
        $degree = $user['UserProfile']['degree'];
    }else{
        $degree = $user['UserProfile']['degree_name'];
    }
    addEncodedField($user['User']['id'], $isLatin1, $this);
    addEncodedField($user['UserProfile']['firstname'], $isLatin1, $this);
    addEncodedField($user['UserProfile']['surname'], $isLatin1, $this);
    addEncodedField($user['UserProfile']['street'], $isLatin1, $this);
    addEncodedField($user['UserProfile']['zip'], $isLatin1, $this);
    addEncodedField($user['UserProfile']['city'], $isLatin1, $this);
    addEncodedField($user['UserProfile']['phone'], $isLatin1, $this);
    addEncodedField($user['UserProfile']['School']['name'], $isLatin1, $this);
    addEncodedField($user['UserProfile']['SchoolCity']['name'], $isLatin1, $this);
    addEncodedField($user['UserProfile']['company'], $isLatin1, $this);
    addEncodedField($user['UserProfile']['company_city'], $isLatin1, $this);
    addEncodedField($user['UserProfile']['trainer_firstname'], $isLatin1, $this);
    addEncodedField($user['UserProfile']['trainer_surname'], $isLatin1, $this);
    addEncodedField(($user['UserProfile']['fileupload'] || $user['UserProfile']['certificate']) ? 'Liegt vor' : '', $isLatin1, $this);
    addEncodedField($user['User']['email'], $isLatin1, $this);
    addEncodedField($user['UserPoint']['points'], $isLatin1, $this);
    addEncodedField($user['UserPoint']['finished'], $isLatin1, $this);
    addEncodedField($user['UserProfile']['tls'], $isLatin1, $this);
    addEncodedField($degree, $isLatin1, $this);
    $this->csv->endRow();
}

echo $this->csv->render('Wettbewerb.csv');

function addEncodedField($value, $isLatin1, $that)
{
    if ($isLatin1)
    {
        $value = utf8_decode($value);
    }
    $that->csv->addField($value);
}