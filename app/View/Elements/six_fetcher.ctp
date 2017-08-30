<?php
$hInData = array('template' => $template);
$hOptions = array('readonly'=>'on');
$hError = CMSAPI::Embed($hInData, $sOutData, $hOptions);
echo $sOutData;
