<div class="users form">
    <?php echo $this->Session->flash(); ?>
    <h1>Portraitfoto</h1>
    <a href="/users/edit" class="btn-white"><span>Zum Profil</span></a>
    <a href="/users/edit_upload" class="btn-white"><span>Immatrikulationsbescheinigung hochladen</span></a>
    <?php echo $this->Form->create('User', array('type' => 'file')); ?>
    <fieldset>
        <?php if(!empty($user['UserProfile']['picupload'])): ?>
        <div class="highlighted">
            <strong>Aktuelle Datei:</strong><br /><br />
            <strong>Thumbnail:</strong><br />
            <?php echo $this->Html->image( DS . 'files' . DS . 'user_profile' .  DS . 'picupload' . DS . $user['UserProfile']['id'] . DS . 'thumb_' . $user['UserProfile']['picupload'], array('alt' => 'Portrait')); ?><br /><br />
            <strong>Vollbild:</strong><br />
            <?php echo $this->Html->image( DS . 'files' . DS . 'user_profile' .  DS . 'picupload' . DS . $user['UserProfile']['id'] . DS . 'large_' . $user['UserProfile']['picupload'], array('alt' => 'Portrait')); ?>
            <br /><br />
        </div>
        <?php endif; ?>
        <?php
        echo $this->Form->input('User.id');
        echo $this->Form->input('UserProfile.id');
        echo $this->Form->input('UserProfile.picupload', array('type' => 'file','label' => 'Foto'));
        echo $this->Form->input('UserProfile.picupload_dir', array('type' => 'hidden'));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Speichern')); ?>
    <div class="clear"></div>
</div>