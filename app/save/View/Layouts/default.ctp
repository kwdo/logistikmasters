<?php
       echo $this->element('vr_header', array('cache'=> array('key' => 'header', 'time' => '+1 hour')));

        echo '<div id="content">';
        if($this->name != 'Users'):
        //echo $this->element('form_header');
        $GLOBALS['_nav3'] = 1035201;
        elseif($this->name == 'Users'):
        $GLOBALS['_nav3'] = 1035202;
        endif;
?>

            <?php echo $this->Session->flash(); ?>
            <?php echo $this->Session->flash('auth'); ?>

			<?php echo $this->fetch('content'); ?>
            <?php echo $this->element('vr_footer', array('cache'=> array('key' => 'footer', 'time' => '+1 hour')));
