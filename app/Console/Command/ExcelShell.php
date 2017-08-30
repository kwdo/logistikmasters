<?php
App::uses('AppShell', 'Console/Command');
App::uses('ComponentCollection', 'Controller');
App::uses('PhpExcelComponent', 'Controller/Component');
App::uses('CakeEmail', 'Network/Email');


class ExcelShell extends AppShell
{
    public $uses = array('Form','User','Report');
    public function main()
    {

        $needed_reports = $this->Report->find('all',array('conditions'=>array('Report.sended'=>0)));
        if(!empty($needed_reports)){

        $year_id = CURRENT_YEAR_ID;
        $year = CURRENT_YEAR;
        $filename = TMP . 'mail_attachments' . DS . 'export_' . date("Y-d-m_H_i") . '.xls';
        Configure::write('debug', 2);
        ini_set('memory_limit', '512M');
        set_time_limit(0);







        $formsContain = array(
            'Question'=>array(
                'fields' => array('id','question','points'),
                'Answer' => array('fields' => array('id','answer','correct'))
            )
        );
        $forms = array();
        $formsArray = $this->Form->find('all',array('conditions'=>array('year'=>$year_id + 12),'order' => array('Form.online_date'   => 'asc'),'contain'=>$formsContain));
        foreach($formsArray as $form){
            $tmp = array();
            $tmp['id'] = $form['Form']['id'];
            $tmp['title'] = $form['Form']['title'];
            $tmp['id'] = $form['Form']['id'];
            $tmp['questions'] = array();
            foreach($form["Question"] as $question){
                $tmpQuestion = array(
                    'id' => $question['id'],
                    'question' => $question['question'],
                    'points' => $question['points'],
                    'answers' => array()
                );
                foreach($question['Answer'] as $answer){
                    $tmpQuestion['answers'][] = array(
                        'id' => $answer['id'],
                        'answer' => $answer['answer'],
                        'correct' => $answer['correct']
                    );
                }
                $tmp['questions'][] = $question;
            }
            $forms[] = $tmp;
        }



        $conditions = array(
            'UsersYears.year_id' => $year_id
        );

        $this->User->unbindModel(
            array('hasOne' => array('UserCatalog')), false
        );

        $this->User->bindModel(array('hasOne' => array('UsersYears')), false);


        $contain = array(
            'UserProfile'=>array('firstname','surname','tls', 'degree', 'degree_name'),
            'UserPoint' => array(
                'conditions' => array(
                    'UserPoint.year' => $year_id + 12
                )
            ),
            'UsersYears',
            'Question' => array(
                'fields'=>array('id'),
                'QuestionsUser' => 'answer_id'
            )
        );





        $param = array(
            'conditions' => $conditions,
            'order' => array(
                'UserProfile.surname'   => 'asc',
                'UserProfile.firstname' => 'asc',
                'UserProfile.tls'       => 'asc'
            ),
            'contain' => $contain,
            'fields' => array('id','username','email')
        );

        $users = $this->User->find('all',$param);


        //debug($users);



        foreach($users as $key => $user){
            $tmpQuestions = array();
            if(!empty($user['Question'])){
                foreach($user['Question'] as $question){
                    $tmpQuestions[$question['id']] = $question['QuestionsUser']['answer_id'];
                }
            }
            $users[$key]['Question'] = $tmpQuestions;
        }



        $collection = new ComponentCollection();
        $phpExcel = new PhpExcelComponent($collection);
         $objPHPExcel = $phpExcel->createWorksheet();

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
            $userRow[] = $user['UserProfile']['tls'];

            if($user['UserProfile']['degree'] == 'nicht in Liste')
            {
                $userRow[] = $user['UserProfile']['degree_name'];
            }
            else
            {
                $userRow[] = $user['UserProfile']['degree'];
            }

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
            array('label' => __('Beendete Fragebögen')),
            array('label' => __('TLS')),
            array('label' => __('Studiengang'))
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
                (!empty($user['UserPoint'][0]['points']) ? $user['UserPoint'][0]['points'] : 0),
                (!empty($user['UserPoint'][0]['finished']) ? $user['UserPoint'][0]['finished'] : 0),
                $user['UserProfile']['tls'],
                ($user['UserProfile']['degree'] == 'nicht in Liste') ? $user['UserProfile']['degree_name'] : $user['UserProfile']['degree']
            ));
        }

        $objPHPExcel->save($filename);

        $fieldlist = array('id','sended');

        foreach($needed_reports as $nr){
            if($nr['User']['role']=='admin'){
            $Email = new CakeEmail();
            $Email->from(array('springerfm@knochwerke.de' => 'Logistik Masters'))
                ->to($nr['User']['email'])
                ->subject('Excel Export Logistik Masters')
                ->attachments($filename)
                ->send('Ihr freundlicher Webserver');

            $nr['Report']['sended'] = 1;
            $this->Report->save($nr,array('fieldlist'=>$fieldlist));
            }
        }




        $this->out('Done.');
    }
    }


}

?>