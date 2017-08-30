<?php echo $this->Html->script('users_add', array('block' => 'scriptBottom')); ?>
<div class="users form">
    <?php echo $this->Session->flash(); ?>
    <h2> Profil bearbeiten</h2>
    <?php echo $this->Form->create('User'); ?>
     <fieldset>
    	<h5>Rolle:</h5>
        <?php
    	$roles = array('admin' => 'Administrator', 'user' => 'Benutzer');
		echo $this->Form->input('role', array('options' => $roles));
		?>
	</fieldset>
    <fieldset>
        <h5>Persönliche Daten:</h5>
        <?php
        echo $this->Form->input('UserProfile.firstname', array('label' => 'Vorname'));
        echo $this->Form->input('UserProfile.surname', array('label' => 'Nachname'));
        echo $this->Form->input('UserProfile.street', array('label' => 'Straße / Postfach'));
        echo $this->Form->input('UserProfile.zip', array('label' => 'PLZ'));
        echo $this->Form->input('UserProfile.city', array('label' => 'Ort'));
        echo $this->Form->input('UserProfile.phone', array('label' => 'Telefon'));
        ?>
        <h5> Daten zum Studium:</h5>
        <?php
        echo $this->Form->input('UserProfile.school_city_id', array('label' => 'Ort der Hochschule','empty' => 'Bitte wählen'));
        echo $this->Form->input('UserProfile.school_id', array('label' => 'Hochschulname','empty' => 'Bitte wählen'));
        ?>
        <div id="hideMe">
            <h3>Bitte ergänzen Sie die folgenden Infos manuell:</h3>
            <?php
            echo $this->Form->input('UserProfile.school_city_name', array('label' => 'Ort der Hochschule'));
            echo $this->Form->input('UserProfile.school_name', array('label' => 'Hochschule'));
            ?>
        </div>
        <?php
        $hochschulart = array(  'Berufsakademie'=>'Berufsakademie',
            'Duale Hochschule'=>'Duale Hochschule',
            'Fachhochschule'=>'Fachhochschule',
            'Universität'=>'Universität',
            'Sonstiges'=>'Sonstiges');
        echo $this->Form->input('UserProfile.company', array('options' => $hochschulart,'label' => 'Hochschulart','empty' => 'Bitte wählen'));
        echo $this->Form->input('UserProfile.trainer_firstname', array('label' => LABEL_TRAINER_FIRSTNAME));
        echo $this->Form->input('UserProfile.trainer_surname', array('label' => LABEL_TRAINER_SURNAME));
        echo $this->Form->input('UserProfile.company_city', array('label' => 'Fachrichtung'));
        ?>
    </fieldset>
     <fieldset>
        <h5>Status:</h5>
		<?php echo $this->Form->input('User.doubleoptin', array('label' => 'Aktiviert')); ?>
	 </fieldset>
    <fieldset>
        <h5>Login Daten:</h5>
        <?php
        echo $this->Form->input('User.id');
        echo $this->Form->input('username', array('label' => 'Benutzername'));
        echo $this->Form->input('email', array('label' => 'E-Mail'));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Speichern')); ?>
    <div class="clear"></div>
</div>