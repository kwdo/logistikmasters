<?php echo $this->Html->script('swfobject', array('block' => 'script')); ?>

<div class="spacertop blue formHeader">
	<div class="right">
		<div class="formProgress">
			<?php
				for($i=1; $i<=$questionCount; $i++):
					if($i <= ($question['Question']['order'] + 1))
						echo '<div class="active"></div>';
					else
						echo '<div></div>';
				endfor;
			 ?>
		</div>
		Frage <strong><?php echo $question['Question']['order'] + 1; ?></strong> von <?php echo $questionCount; ?>
	</div>
	<h3>Fragebogen <?php echo $question['Form']['title']; ?> | <?php echo $question['Question']['points']; ?> Punkte</h3>
</div>

<?php
	if($question['Question']['type'] == 'bonus')
		echo '<p class="blue">Hinweis: &bdquo;Bonusfragen&ldquo; haben keinen Einfluss auf Ihren Gesamtpunktestand.</p>';
?>
<?php /* start new */ ?>
<?php echo $this->Form->create('Question', array('action' => 'save','class'=>'questionForm')); ?>
<div class="questionbox <?php echo $blocked ? 'blocked' : '' ?>">
    <div class="header">
    <?php if($question['Question']['type'] == 'normal'): ?>
            <div class="number"><?php echo $question['Question']['order'] + 1; ?>.</div>
            <div class="question"><?php echo $question['Question']['question']; ?></div>
    <?php else: ?>
            <?php
            if($question['Question']['special_photo']):
                echo $this->Html->image('uploads/special-'.$question['Question']['id'].'-'.$question['Question']['special_photo']);
            endif;
            ?>

        <h3><?php echo $GLOBALS['questionTypes'][$question['Question']['type']]; ?></h3>
        <?php if($question['Question']['type'] == 'bonus')
            echo '<h4>(gültig vom '.$this->Time->format("d.m.", $question['Question']['online_date']).'
						&ndash; '.$this->Time->format("d.m.Y", $question['Question']['offline_date']).')</h4>';
        ?>
        <h4><?php echo $question['Question']['special_name']; ?></h4>
            <p class="text"><?php echo $question['Question']['special_desc']; ?><p>
            <div class="clear"></div>
            <div class="number"><?php echo $question['Question']['order'] + 1; ?>.</div>
            <div class="question"><?php echo $question['Question']['question']; ?></div>
    <?php endif; ?>
    </div>

    <div class="content">
       <?php
        if($question['Question']['image'])
            echo $this->Html->image('uploads/'.$question['Question']['id'].'-'.$question['Question']['image']);
        if(isset($showVideo)):
            echo $showVideo;
        endif;

        $options = array();
        foreach($question['Answer'] as $answer) {
            if(!empty($answer['answer']))
                $options[$answer['id']] = $answer['answer'];
        }
        $presel = isset($question['User'][0]['QuestionsUser']['answer_id']) ? $question['User'][0]['QuestionsUser']['answer_id'] : 0;
        echo $this->Form->input('Answer.id', array('type' => 'radio', 'options' => $options, 'div' => 'formAnswers', 'value' => $presel, 'disabled' => $blocked, 'legend'=>false,'before'=>'<ul><li>','after'=>'</li></ul>', 'separator'=>'</li><li>'));

        if($question['Question']['file'])
            echo $this->Html->link('Datei-Download',
                '/files/uploads/'.$question['Question']['id'].'-'.$question['Question']['file'],
                array('class' => 'more blue'));

        ?>
    </div>
</div>



<?php /* endnew */ ?>



<?php echo $this->Form->hidden('Question.id', array('value' => $question['Question']['id'])); ?>

<?php
	echo $this->Html->link('Speichern und zur Übersicht', array('controller' => 'forms', 'action' => 'index'), array('class' => 'btn-wettbewerb-white', 'style' => 'float:left','id'=>'btnSubmitandGoToOVerview'));

	$next = $neighbors['next']['Question']['id'];
	$prev = $neighbors['prev']['Question']['id'];

	if($next):
		if($blocked):
			echo $this->Html->link('weiter', array('action' => 'view', $next), array('class' => 'btn-wettbewerb-white'));
		else:
			echo $this->Form->hidden('Question.show', array('value' => $next));
			echo '<input type="submit" class="btn-wettbewerb-white" name="button" value="weiter" />';
		endif;
	else:
		if(!$blocked):
			echo $this->Form->hidden('Question.finished', array('value' => 1));
			echo '<input type="submit" class="btn-wettbewerb-white" id="closeForm" name="button" value="abschließen und einsenden" />';
		elseif(!$finished):
			echo $this->Html->link('abschließen', array('action' => 'finish', $question['Question']['form_id']), array('class' => 'btn-wettbewerb-white', 'id' => 'closeForm'));
		endif;
	endif;
	
	if($prev):
		echo $this->Html->link('zurück', array('action' => 'view', $prev), array('class' => 'btn-wettbewerb-white mr-10'));
	endif;
?>
</form>

<script type="text/javascript">
<!--
	if(document.getElementById('closeForm'))
		document.getElementById('closeForm').onclick = function() {
			return confirm('Wollen Sie den Fragebogen wirklich abschließen? Danach können keine Bearbeitungen mehr vorgenommen werden.');
	}

$('#btnSubmitandGoToOVerview').click(function(e){
    e.preventDefault();
    if($('input[name="data[Answer][id]"]').is(':checked')){
        $('#QuestionFinished').remove();
        $('#QuestionSaveForm').append('<input id="SendToOverview" type="hidden" value="1" name="data[Form][send_to_overview]">');
        $('#QuestionSaveForm').submit();
    }else{
        window.location.href = '/forms';
    }
});
//-->
</script>







