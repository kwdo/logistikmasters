<?php
echo $this->element('vr_header');
?>
<div id="content">
  <?php
  echo $this->Session->flash();
  echo $this->Session->flash('auth');
  echo $this->fetch('content');
  ?>
</div>

<?php echo $this->element('vr_footer'); ?>
