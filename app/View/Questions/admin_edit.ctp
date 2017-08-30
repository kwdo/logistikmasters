<?php echo $this->Html->script('tiny_mce/tiny_mce', array('block' => 'script')); ?>
<div class="actions">
	<?php echo $this->Html->link(
    $this->Html->image('admin/reload.gif') . "Zurück zum Fragebogen",
    array('controller' => 'forms', 'action' => 'view', $this->request->data['Question']['form_id']),
    array('escape' => false)
);
    ?>
</div>
<?php
	if(isset($this->request->data['Question']['type']))
		$qType = $this->request->data['Question']['type'];
	else
		$qType = 'normal';
	echo $this->Form->create('Question', array('type' => 'file'));
?>
	<fieldset>
 		<legend>Frage <?php echo isset($newForm) ? 'hinzufügen' : 'bearbeiten'; ?></legend>
	<?php
		if(!isset($newForm)) echo $this->Form->input('id');
		echo $this->Form->input('form_id', array('type' => 'hidden'));
		echo $this->Form->input('question', array('label' => 'Frage', 'type' => 'textarea','class'=>'mceEditor'));
		echo $this->Form->input('type', array('label' => 'Typ', 'type' => 'select', 'options' => $GLOBALS['questionTypes']));
		echo $this->Form->input('points', array('label' => 'Punkte'));
		echo $this->Form->input('image', array('label' => 'Bild', 'type' => 'file'));
		echo (isset($this->request->data['Question']['image']) && $this->request->data['Question']['image']) ? 
			$this->Html->image('uploads/'.$this->request->data['Question']['id'].'-'.$this->request->data['Question']['image']) : '';
		echo $this->Form->input('image_delete', array('label' => 'Bild löschen', 'type' => 'checkbox'));
		echo $this->Form->input('file', array('label' => 'Dateianhang', 'type' => 'file'));
		echo (isset($this->request->data['Question']['file']) && $this->request->data['Question']['file']) ? $this->Html->link($this->request->data['Question']['file'],
			'/files/uploads/'.$this->request->data['Question']['id'].'-'.$this->request->data['Question']['file']) : '';
		
		if($qType != 'bonus' && $qType != 'video') $style = 'style="display:none"';
		else $style = '';
		
		echo '<fieldset id="bonusField" '.$style.'><legend>Aktiver Zeitraum</legend>';
		echo $this->Form->input('online_date', array('dateFormat' => 'DMY'));
		echo $this->Form->input('offline_date', array('dateFormat' => 'DMY'));
		echo '</fieldset>';
		echo '<br />';
		
		if($qType == 'normal' || $qType == 'video') $style = 'style="display:none"';
		else $style = '';
		
		echo '<fieldset id="specialField" '.$style.'><legend>Spezialdaten</legend>';
		echo $this->Form->input('special_photo', array('label' => 'Foto', 'type' => 'file'));
		echo (isset($this->request->data['Question']['special_photo']) && $this->request->data['Question']['special_photo']) ? 
			$this->Html->image('uploads/special-'.$this->request->data['Question']['id'].'-'.$this->request->data['Question']['special_photo']) : '';
		echo $this->Form->input('special_name', array('label' => 'Name'));
		echo $this->Form->input('special_desc', array('label' => 'Beschreibung', 'type' => 'textarea'));
		echo '</fieldset>';
		
		if($qType != 'video') $style = 'style="display:none"';
		else $style = '';
		
		echo '<fieldset id="videoField" '.$style.'><legend>Videodaten</legend>';
		echo $this->Form->input('video_before', array('label' => 'HTML der Videofrage', 'type' => 'textarea'));
		echo $this->Form->input('video_after', array('label' => 'HTML der Videolösung', 'type' => 'textarea'));
		echo '</fieldset>';
	?>
	</fieldset>
	
	<fieldset class="answers">
		<legend>Antworten</legend>
		<?php
			for($i=0; $i<ANSWER_NUMBER; $i++) {
				if(!isset($newForm)) echo $this->Form->input('Answer.'.$i.'.id');
				echo $this->Form->input('Answer.'.$i.'.answer', array('label' => 'Antwort '.($i+1), 'type' => 'textarea','class'=>'mceEditor'));
				echo $this->Form->input('Answer.'.$i.'.correct', array('label' => 'Richtig'));
			}
		?>
	</fieldset>
<?php echo $this->Form->end('Speichern');?>

<script type="text/javascript">
/* <![CDATA[ */
	$('#QuestionType').change(function() {
		var sel = $(this).children('option:selected');
		if(sel.val() == 'normal') {
			$('#specialField').hide();
			$('#bonusField').hide();
			$('#videoField').hide();
		} else if(sel.val() == 'video') {
			$('#videoField').show();
			$('#specialField').hide();
			$('#bonusField').show();		
		} else {
			$('#specialField').show();
			$('#videoField').hide();
			if(sel.val() == 'bonus') {
				$('#bonusField').show();
			}
		}
	});

	// Editor
	tinyMCE.init({
		mode : "specific_textareas",
        editor_selector : "mceEditor",
		button_tile_map: true,
		language: 'de',
		skin: 'o2k7',
		skin_variant: 'black',
		plugins: 'inlinepopups,paste',
		theme: 'advanced',
		theme_advanced_toolbar_location: 'top',
		theme_advanced_toolbar_align: 'left',
		theme_advanced_buttons1: 'undo,redo,cut,copy,pastetext,pasteword,|,bold,italic,underline,charmap,removeformat,|,numlist,bullist,link,unlink,|,indent,outdent,justifycenter,justifyfull,justifyright,|,forecolor,backcolor,fontselect,fontsizeselect,|,cleanup,code,help',
		theme_advanced_buttons2: '',
		theme_advanced_buttons3: '',
		dialog_type: 'modal',
		theme_advanced_statusbar_location: 'bottom',
		theme_advanced_resizing: true,
		theme_advanced_resize_horizontal: false,
		force_br_newlines: true,
        convert_urls: false
	});

/* ]]> */
</script>
