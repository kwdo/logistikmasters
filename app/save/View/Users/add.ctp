<?php echo $this->Html->script('users_add', array('block' => 'scriptBottom')); ?>
<div class="users form">
    <div class="mainHeadline">
        <img src="http://www.verkehrsrundschau.de/bestazubi/wcf/icon/azubi/registerL.png" alt="" />
        <div class="headlineContainer">
            <h2> Registrieren</h2>
        </div>
    </div>

    <div class="panorama">
        <img src="http://www.verkehrsrundschau.de/fm/4494/banner.1129131.jpg" alt="Best Azubi 2013" />
    </div>

    <?php echo $this->Session->flash(); ?>

    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <h5>Persönliche Daten:</h5>
        <?php
        echo $this->Form->input('Profile.firstname', array('label' => 'Vorname'));
        echo $this->Form->input('Profile.surname', array('label' => 'Nachname'));
        echo $this->Form->input('Profile.street', array('label' => 'Straße / Postfach'));
        echo $this->Form->input('Profile.zip', array('label' => 'PLZ'));
        echo $this->Form->input('Profile.city', array('label' => 'Ort'));
        echo $this->Form->input('Profile.phone', array('label' => 'Telefon'));
         ?>
        <h5>Hochschule:</h5>
        <?php
        echo $this->Form->input('Profile.school_city_id', array('label' => 'Ort der Berufsschule','empty' => 'Bitte wählen'));
        echo $this->Form->input('Profile.school_id', array('label' => 'Berufsschule','empty' => 'Bitte wählen'));
        ?>
        <div id="hideMe">
            <h3>Bitte ergänzen Sie die folgenden Infos manuell:</h3>
<?php
        echo $this->Form->input('Profile.school_city_name', array('label' => 'Ort der Berufsschule'));
        echo $this->Form->input('Profile.school_name', array('label' => 'Berufsschule'));
?>
        </div>
        <h5>Informationen zur Ausbildung:</h5>
<?php

        echo $this->Form->input('Profile.company', array('label' => 'Ausbildungsbetrieb'));
        echo $this->Form->input('Profile.company_city', array('label' => 'Ort des Ausbildungsbetriebes'));
        echo $this->Form->input('Profile.trainer_firstname', array('label' => 'Ausbilder Vorname'));
        echo $this->Form->input('Profile.trainer_surname', array('label' => 'Ausbilder Nachname'));
        echo $this->Form->input('Profile.year_of_apprenticeship', array('label' => 'Lehrjahr'));
        echo $this->Form->input('Profile.career_aspiration', array('label' => 'Berufswunsch'));
        ?>
    </fieldset>
	<fieldset>
		<h5>Login Daten:</h5>
	<?php
		echo $this->Form->input('username', array('label' => 'Benutzername'));
		echo $this->Form->input('email', array('label' => 'E-Mail'));
        echo $this->Form->input('email_repeat', array('label' => 'E-Mail wiederholen'));
		echo $this->Form->input('password', array('label' => 'Passwort', 'type' => 'password'));
        echo $this->Form->input('password_repeat', array('label' => 'Passwort wiederholen', 'type' => 'password'));
	?>
	</fieldset>    
<?php echo $this->Form->end(__('Speichern')); ?>
<div class="clear"></div>
</div>