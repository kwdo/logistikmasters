<?php

$this->csv->addRow(array_keys($data[0]));

foreach ($data as $user)
{
    if ($isLatin1)
    {
        foreach ($user as $key => $value)
        {
            $user[$key] = utf8_decode($value);
        }
    }
    $this->csv->addRow($user);
}

echo $this->csv->render('Bonusfrage.csv');
?>