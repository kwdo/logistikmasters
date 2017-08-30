<?php
$objPHPExcel = $this->PhpExcel->createWorksheet();

$objPHPExcel->getProperties()
    ->setCreator("Springer Webserver")
    ->setLastModifiedBy("Springer Webserver")
    ->setTitle("Ergebnisse Logistik Masters $year")
    ->setSubject("Ergebnisse Logistik Masters $year")
    ->setDescription(
        "Bitte nicht ändern."
    );



$analysisForms = array();
$questionCounter = 2;
$questions = array();
foreach($forms as $form){
    $form['blockStart'] = PHPExcel_Cell::stringFromColumnIndex($questionCounter+1);
    $form['addedCells'] = count($form['questions'])-1;
    $questionCounter += count($form['questions']);
    $form['blockEnd'] = PHPExcel_Cell::stringFromColumnIndex($questionCounter);
    $tmpQuestions = array();
    foreach($form['questions'] as $question){
        $tmpQuestion = array();
        $tmpQuestion = array('id'=>$question['id'],'points'=>$question['points']);
        foreach($question['Answer'] as $answer){
            if($answer['correct']){
                $tmpQuestion['correct'] = $answer['id'];
                break;
            }
        }
        $tmpQuestions[] = $tmpQuestion;
        $questions[] = $tmpQuestion;
    }
    unset($form['questions']);
    $analysisForms[] = $form;
}



//worksheet protection
$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
$objPHPExcel->getActiveSheet()->setTitle('Benutzer Fragebögen');

$formsRow = array('','','');
foreach($analysisForms as $form){
    $formsRow[] = $form['title'];
    for($i=1;$i<=$form['addedCells'];$i++){
        $formsRow[] = '';
    }
}
$activeRow = $objPHPExcel->getRow();
$objPHPExcel->addTableRow($formsRow);
//Merge Cells
foreach($analysisForms as $form){
    $toBeFormattedName = $form['blockStart'] .  $activeRow . ':' .  $form['blockEnd'] . $activeRow;
    $objPHPExcel->getActiveSheet()->mergeCells($toBeFormattedName);
}

$labelRow = array(array('label' => 'userID'),
    array('label' => 'Vorname'),
    array('label' => 'Nachname'));
foreach($questions as $q){
    $labelRow[] = array('label' => $q['id']);
}
$labelRow[] = 'Punkte';
$objPHPExcel->addTableHeader($labelRow, array('name' => 'Cambria', 'bold' => true));



foreach($users as $user){
    $userRow = array($user['User']['id'],$user['UserProfile']['firstname'],$user['UserProfile']['surname']);
    $tmpPoints = 0;
    foreach($questions as $question){
        $tmpAnswer = '';
        if(!empty($user['Question'][$question['id']])){
            $tmpAnswer = $user['Question'][$question['id']];
            if($tmpAnswer == $question['correct']){
                $tmpAnswer .= ' (+' . $question['points'] . ')';
                $tmpPoints += $question['points'];
            }else{
                $tmpAnswer .= ' ( 0)';
            }
        }
        $userRow[] = $tmpAnswer;
    }
    $userRow[] = $tmpPoints;



    $objPHPExcel->addTableRow($userRow);
}




// close table and output


// define table cells
$questionTable = array(
    array('label' => __('ID'), 'width' => 20),
    array('label' => __('Frage')),
    array('label' => '', 'width' => 300),
    array('label' => ''),
    array('label' => __('Punkte'))
);


// define table cells
$answerTable = array(
    array('label' => ''),
    array('label' => __('ID'), 'width' => 20),
    array('label' => __('Anwort'), 'width' => 200),
    array('label' => __('Richtig'))
);



$objPHPExcel->addSheet('Fragebögen', 1);
$objPHPExcel->setActiveSheetIndex(1);

foreach($forms as $form){
    $activeRow = $objPHPExcel->getRow();
    $objPHPExcel->addTableRow(array($form['title']));
    $toBeFormattedName = 'A' .  $activeRow . ':E' . $activeRow;

    $objPHPExcel->getActiveSheet()->getStyle($toBeFormattedName)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
    $objPHPExcel->getActiveSheet()->getStyle($toBeFormattedName)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle($toBeFormattedName)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
    $objPHPExcel->getActiveSheet()->getStyle($toBeFormattedName)->getFill()->getStartColor()->setARGB('B7B7B7');
    $objPHPExcel->getActiveSheet()->mergeCells($toBeFormattedName);
    $activeRow++;
    $toBeFormattedName = 'B' .  $activeRow . ':D' . $activeRow;
    $objPHPExcel->addTableHeader($questionTable, array('name' => 'Cambria', 'bold' => true));
    $objPHPExcel->getActiveSheet()->mergeCells($toBeFormattedName);
    foreach($form['questions'] as $question){
        unset($question['form_id']);
        $question['question'] = strip_tags(html_entity_decode($question['question'],ENT_QUOTES,'UTF-8'));
        $activeRow = $objPHPExcel->getRow();
        $toBeFormattedName = 'B' .  $activeRow . ':D' . $activeRow;
        $objPHPExcel->addTableRow(array($question['id'],$question['question'],'','',$question['points']));
        $objPHPExcel->getActiveSheet()->mergeCells($toBeFormattedName);
        $objPHPExcel->getActiveSheet()->getStyle($toBeFormattedName)->getAlignment()->setWrapText(true);
        $objPHPExcel->addTableHeader($answerTable, array('name' => 'Cambria', 'bold' => true));
        foreach($question['Answer'] as $answer){
            $answer['answer'] = strip_tags(html_entity_decode($answer['answer'],ENT_QUOTES,'UTF-8'));
            $objPHPExcel->addTableRow(array('',$answer['id'],$answer['answer'],$answer['correct'] ? 'X' : ''));
        }
    }
}


$objPHPExcel->addSheet('Benutzer Ergebnisse', 2);
$objPHPExcel->setActiveSheetIndex(2);
// define table cells
$table = array(
    array('label' => __('User ID'), 'filter' => true),
    array('label' => __('Vorname'), 'filter' => true),
    array('label' => __('Nachname')),
    array('label' => __('E-Mail'), 'width' => 50, 'wrap' => true),
    array('label' => __('Punkte')),
    array('label' => __('Beendete Fragebögen'))
);

// add heading with different font and bold text
$objPHPExcel->addTableHeader($table, array('name' => 'Cambria', 'bold' => true));

// add data
foreach ($users as $user) {
    $objPHPExcel->addTableRow(array(
        $user['User']['id'],
        $user['UserProfile']['firstname'],
        $user['UserProfile']['surname'],
        $user['User']['email'],
        ($user['UserPoint']['points'] ? $user['UserPoint']['points'] : 0),
        $user['UserPoint']['finished']
    ));
}


$objPHPExcel->output('test.xls');


