<?php echo $this->Html->script('users_add', array('block' => 'scriptBottom')); ?>
<div class="users form">
    <h1>Registrieren</h1>
    <?php echo $this->Html->image('https://www.verkehrsrundschau.de' . $GLOBALS['controlArticle']['register_upload']['systemurl'], array("style" => "margin-bottom: 10px;")); ?>

    <?php echo $this->Session->flash(); ?>

    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <h5>Persönliche Daten:</h5>
        <?php
        $geschlecht = array(  'weiblich'=>'weiblich',
            'männlich'=>'männlich');
        echo $this->Form->input('UserProfile.gender', array('label' => 'Geschlecht','options' => $geschlecht,'empty' => 'Bitte wählen'));
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

        $degree = array('Master'         => 'Master',
                        'Bachelor'       => 'Bachelor',
                        'nicht in Liste' => 'nicht in Liste'
        );
        echo $this->Form->input('UserProfile.degree', array('options' => $degree,'label' => 'Angestrebter Abschluss','empty' => 'Bitte wählen'));
?>
        <div id="UserProfileDegreeSection">
<?php
        echo $this->Form->input('UserProfile.degree_name', array('label' => 'Angestrebter Abschluss'));
?>
        </div>
<?php
        echo $this->Form->input('UserProfile.company_city', array('label' => 'Fachrichtung'));
        echo $this->Form->input('apprentice', array('type' => 'checkbox', 'label' => 'Hiermit bestätige ich, dass ich während meiner Teilnahme bei LOGISTIK MASTERS an einer Hochschule immatrikuliert bin.'));
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
    <fieldset>
        <?php
        echo $this->Form->input('precondition', array('type' => 'checkbox', 'label' => 'Ja, ich akzeptiere die <a href="/teilnahmebedingungen" target="blank">Teilnahmebedingungen</a> von Logistik Masters.'));
        ?>
    </fieldset>
	<p class="font-size: 11px"><sup style="color: #EE3322;">*</sup> Pflichtfelder</p>
    <p><b>Datenschutz:</b> Bei gegebenem Anlass werden wir Ihre E-Mail-Adresse nutzen, um Sie über ähnliche Waren bzw. Dienstleistungen zu informieren. Sie können dieser Nutzung jederzeit durch eine E-Mail an <a href="mailto:wettbewerbe@springer.com">wettbewerbe@springer.com</a> oder ein Fax an (089) 20 30 43 23 77 widersprechen, ohne dass hierfür andere als die Übermittlungskosten nach den Basistarifen entstehen. Es gelten die AGB der Springer Fachmedien GmbH - <a href="http://www.springerfachmedien-muenchen.de/agb" target="_blank">www.springerfachmedien-muenchen.de/agb</a></p>

<?php echo $this->Form->end(__('Speichern')); ?>
<div class="clear"></div>
</div>