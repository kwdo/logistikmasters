<?php
$loc = $this->request->params['controller'];
?>
<ul id="nav1">
    <?php foreach($items as $key => $value): ?>
    <li <?php if($loc == $key) echo 'class="active"'; ?>>
        <?php echo $this->Html->link($value, array('controller' => $key, 'action' => 'index')); ?></li>
    <?php endforeach ?>
    <li><?php echo $this->Html->link('Zum Frontend wechseln', array('controller' => 'pages', 'action' => 'home','admin'=> false)); ?></li>
</ul>