<style>
	.box h3,
	#content .box .content,
	#content .box{
		height:auto;
	}
	#content .box .content{
		overflow:visible;
	}
	legend {
		display:none;
	}
	fieldset {
		border:none;
	}
	input {
		margin-right:0.5em;
	}
</style>
<?php
$GLOBALS['title'] = utf8_decode('Fragebogen - ' . (IS_BEST_AZUBI ? 'Best Azubi' : 'Logistik Masters'));
?><p><a href="javascript:print();" class="boxLink boxLinkBlue">Drucken</a></p>
<div class="clear"></div>

<?php foreach($formData['Question'] as $question): ?>
<div class="spacertop box bluer">
	<?php if($question['type'] == 'normal'): ?>
		<h3>
			<div class="number"><?php echo $question['order'] + 1; ?>.</div>
			<div class="question"><?php echo $question['question']; ?></div>
		</h3>
	<?php else: ?>
		<h3 class="special">
			<?php
				if($question['special_photo']):
					echo $this->Html->image('uploads/special-'.$question['id'].'-'.$question['special_photo']);
				endif;
			?>
			<p class="head">
				<span><?php echo $GLOBALS['questionTypes'][$question['type']]; ?></span>
				<?php if($question['type'] == 'bonus')
					echo '(gültig vom '.$this->Time->format("d.m.", $question['online_date']).'
						&ndash; '.$this->Time->format("d.m.Y", $question['offline_date']).')';
				?>
			</p>
			<p class="sub"><?php echo $question['special_name']; ?></p>
			<p class="text"><?php echo $question['special_desc']; ?><p>
			<div class="clear"></div>
		</h3>
	<?php endif; ?>
	<div class="clear"></div>
	<div class="content">
		<?php if($question['type'] != 'normal')
				echo '<p class="blue special"><span>'.($question['order'] + 1).'</span>. '.$question['question'].'</p>';
		
			if($question['image'])
				echo $this->Html->image('uploads/'.$question['id'].'-'.$question['image']);
		
			$options = array();
			foreach($question['Answer'] as $answer) {
				$options[$answer['id']] = $answer['answer'];
			}
			$presel = isset($question['User'][0]['QuestionsUser']['answer_id']) ? $question['User'][0]['QuestionsUser']['answer_id'] : 0;
			echo $this->Form->input('Answer.'.$question['id'].'.id', array('type' => 'radio', 'options' => $options, 'div' => 'formAnswers', 'value' => $presel, 'disabled' => true, 'separator' => '<br /><br />'));

			if($question['file']) {
				echo '<p>'.$this->Html->link('PDF Download',
					'/files/uploads/'.$question['id'].'-'.$question['file'],
					array('class' => 'more blue')).'</p>';
			}
		?>
	</div>
</div>
<?php endforeach; ?>