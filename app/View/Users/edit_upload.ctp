<div class="users form">
    <?php echo $this->Session->flash(); ?>
    <h2>Immatrikulationsbescheinigung einreichen</h2>
    <a href="/users/edit" class="btn-white"><span>Zum Profil</span></a>
    <a href="/users/edit_pic_upload" class="btn-white"><span>Portraitfoto hochladen</span></a>
    <?php echo $this->Form->create('User', array('type' => 'file')); ?>
    <fieldset>        
        <?php if(!empty($user['UserProfile']['fileupload'])): ?>
        <div class="highlighted">
        Du hast bereits die Datei <?php echo $this->Html->link($user['UserProfile']['fileupload'], DS . 'files' . DS . 'user_profile' .  DS . 'fileupload' . DS . $user['UserProfile']['id'] . DS . $user['UserProfile']['fileupload'],array('target' =>'_blank')); ?> hochgeladen.
        </div>
        <?php endif; ?>
        <?php
        echo $this->Form->input('User.id');
        echo $this->Form->input('UserProfile.id');
        echo $this->Form->input('UserProfile.fileupload', array('type' => 'file','label' => 'Immatrikulationsbescheinigung'));
        echo $this->Form->input('UserProfile.fileupload_dir', array('type' => 'hidden'));     
        ?>
     </fieldset>     
    <?php echo $this->Form->end(__('Speichern')); ?>
    <div class="clear"></div>
</div>