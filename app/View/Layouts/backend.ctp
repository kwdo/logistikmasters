<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php
    echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js');
    echo $this->Html->css(array('cake.old', 'backend'));
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>

    <title>Adminbereich</title>
</head>
<body>
<div id="container">
    <div id="header">
        <h1>Knochwerke</h1>
        <div id="nav">
            <ul id="nav1">
                <?php echo $this->element('admin_menu', array('items' => array(
                'forms' => 'Fragebögen',
                'users' => 'Benutzer',
                'reports' => 'Excel Report',
                'schools' => 'Hochschulen',
                'school_cities' => 'Hochschulorte',
                'custom_settings' => 'Einstellungen',
                 'years' => 'Jahre',
                'forum' => 'Forum',

            ))); ?>
                <div style="clear:both;"></div>
            </ul>
            <div style="clear:both;"></div>
        </div>
    </div>
    <div id="content">
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->Session->flash('auth'); ?>

        <?php echo $this->fetch('content'); ?>
    </div>
    <div id="footer">
        &nbsp;
    </div>
</div>
<?php echo $this->element('sql_dump'); ?>
<?php echo $this->fetch('scriptBottom'); ?>
<?php
if (class_exists('JsHelper') && method_exists($this->Js, 'writeBuffer')) echo $this->Js->writeBuffer();
// Writes cached scripts
?>
</body>
</html>