<?php echo $this->Html->script('tiny_mce/tiny_mce', array('block' => 'script')); ?>
<div class="settings form">
    <?php echo $this->Form->create(); ?>
    <fieldset>
        <legend><?php echo __('Einstellungen bearbeiten'); ?></legend>
        <?php
        echo $this->Form->input('competion_end', array(
            'type' => 'datetime',
            'selected' => $config['competion_end'],
            'minYear' => date("Y"),
            'maxYear' => date("Y")+1,
            'dateFormat' => 'DMY',
            'interval' => 10,
            'timeFormat' => 24,
            'label' => 'Enddatum'
        ));

        echo $this->Form->input('next_competition', array(
            'type' => 'datetime',
            'selected' => $config['next_competition'],
            'minYear' => date("Y"),
            'maxYear' => date("Y")+1,
            'dateFormat' => 'DMY',
            'interval' => 10,
            'timeFormat' => 24,
            'label' => 'Nächster Wettbewerb'
        ));

        echo $this->Form->input('show_points_in_profile', array(
            'type' => 'checkbox',
            'checked' => $config['show_points_in_profile'],
            'label' => 'Zeige Punkte im Profil'
        ));

        echo $this->Form->input('reactivate_email_text', array(
                'label' => 'Text Reaktivierungsmail',
                'escape' => false,
                'value' => $config['reactivate_email_text'],
                'type' => 'textarea',
                'class'=>'mceEditor',
                'after'=> '<small><b>' . $this->Html->link('&rsaquo;Testmail versenden', array('action' => 'testmail'),
                        array('escape' => false)) . '</b> (Text muss vorher gespeichert worden sein!)</small><br>'
            )
        );
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Speichern')); ?>
</div>

<script type="text/javascript">

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
        theme_advanced_buttons1: 'pastetext,pasteword,|,bold,italic,underline,|,numlist,bullist,|,link,unlink,|,code',
        theme_advanced_buttons2: '',
        theme_advanced_buttons3: '',
        dialog_type: 'modal',
        theme_advanced_statusbar_location: 'bottom',
        theme_advanced_resizing: true,
        theme_advanced_resize_horizontal: false,
        force_br_newlines: true,
        convert_urls: false,
        paste_use_dialog : false,
        paste_auto_cleanup_on_paste : true,
        paste_convert_headers_to_strong : false,
        paste_strip_class_attributes : "all",
        paste_remove_spans : true,
        paste_remove_styles : true,
        paste_retain_style_properties : "",
    });

</script>