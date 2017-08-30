<?php echo $this->Html->script('users_add', array('block' => 'scriptBottom')); ?>

<div class="users form">
    <h1>Profil bearbeiten</h1>
    <a href="/users/edit_password" class="btn-white"><span>Passwort ändern</span></a>
    <a href="/users/edit_upload" class="btn-white"><span>Immatrikulationsbescheinigung</span></a>
    <a href="/users/edit_pic_upload" class="btn-white"><span>Portraitfoto</span></a>

    <?php echo $this->Session->flash(); ?>

		<?php echo $this->Form->create('User'); ?>
    <fieldset>
	    <div class="clear"></div>

	    <h5>Persönliche Daten:</h5>
        <?php
        echo $this->Form->input('UserProfile.id');
        $geschlecht = array(  'weiblich'=>'weiblich',
            'männlich'=>'männlich');
        echo $this->Form->input('UserProfile.gender', array('label' => 'Geschlecht','options' => $geschlecht,'empty' => 'Bitte wählen'));
        echo $this->Form->input('UserProfile.firstname', array('label' => 'Vorname'));
        echo $this->Form->input('UserProfile.surname', array('label' => 'Nachname'));
        echo $this->Form->input('UserProfile.street', array('label' => 'Straße / Postfach'));
        echo $this->Form->input('UserProfile.zip', array('label' => 'PLZ'));
        echo $this->Form->input('UserProfile.city', array('label' => 'Ort'));
        echo $this->Form->input('UserProfile.phone', array('label' => 'Telefon'));
        echo $this->Form->input('UserProfile.nationality', array('label' => 'Nationalität'));
        echo $this->Form->input('UserProfile.birthdate', array('label' => 'Geburtsdatum','dateFormat' => "DMY",'type'=>'date', 'empty' => true, 'minYear' => date('Y')- 40,  'maxYear' => date('Y')-14));
        echo $this->Form->input('UserProfile.birthland', array('label' => 'Geburtsort/-land'));
        ?>
        <h5>Daten zum Studium 1:</h5>
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

        echo $this->Form->input('UserProfile.graduation', array('label' => 'Studienabschluss'));
        echo $this->Form->input('UserProfile.begineducation', array('label' => 'Beginn des Studium','dateFormat' => "DMY",'type'=>'date', 'empty' => true,  'minYear' => date('Y')-10,  'maxYear' => date('Y')+10));
        echo $this->Form->input('UserProfile.endeducation', array('label' => 'Ende des Studium','dateFormat' => "DMY",'type'=>'date', 'empty' => true, 'minYear' => date('Y')-10,  'maxYear' => date('Y')+10));
        echo $this->Form->input('UserProfile.themeofdissertation', array('label' => 'Thema der Abschlussarbeit'));
        echo $this->Form->input('UserProfile.abschlussnote', array('label' => 'Abschlussnote des Studiums'));
        ?>
	    <h5>Daten zum Studium 2:</h5>
	    <?php
		    echo $this->Form->input('UserProfile.school2_city', array('label' => 'Ort der Hochschule','empty' => 'Bitte wählen'));
		    echo $this->Form->input('UserProfile.school2_name', array('label' => 'Hochschulname','empty' => 'Bitte wählen'));
	    ?>
	    <?php
		    $hochschulart = array(  'Berufsakademie'=>'Berufsakademie',
		                            'Duale Hochschule'=>'Duale Hochschule',
		                            'Fachhochschule'=>'Fachhochschule',
		                            'Universität'=>'Universität',
		                            'Sonstiges'=>'Sonstiges');
		    echo $this->Form->input('UserProfile.school2_company', array('options' => $hochschulart,'label' => 'Hochschulart','empty' => 'Bitte wählen'));
		    echo $this->Form->input('UserProfile.school2_trainer_firstname', array('label' => LABEL_TRAINER_FIRSTNAME));
		    echo $this->Form->input('UserProfile.school2_trainer_surname', array('label' => LABEL_TRAINER_SURNAME));
		    echo $this->Form->input('UserProfile.school2_company_city', array('label' => 'Fachrichtung'));
		    echo $this->Form->input('UserProfile.school2_graduation', array('label' => 'Studienabschluss'));
		    echo $this->Form->input('UserProfile.school2_begineducation', array('label' => 'Beginn des Studium','dateFormat' => "DMY",'type'=>'date', 'empty' => true, 'minYear' => date('Y')-10,  'maxYear' => date('Y')+10));
		    echo $this->Form->input('UserProfile.school2_endeducation', array('label' => 'Ende des Studium','dateFormat' => "DMY",'type'=>'date', 'empty' => true, 'minYear' => date('Y')-10,  'maxYear' => date('Y')+10));
		    echo $this->Form->input('UserProfile.school2_themeofdissertation', array('label' => 'Thema der Abschlussarbeit'));
		    echo $this->Form->input('UserProfile.school2_abschlussnote', array('label' => 'Abschlussnote des Studiums'));
	    ?>
    </fieldset>
    <fieldset>
        <h5>Login Daten:</h5>
        <?php
        echo $this->Form->input('User.id');
        echo $this->Form->input('username', array('label' => 'Benutzername'));
        echo $this->Form->input('email', array('label' => 'E-Mail'));
        ?>
    </fieldset>
    <fieldset>
        <h5>Gesuchte Tätigkeit:</h5>
        <?php
        $beschaeftigungsart = array(  'Praktikum'=>'Praktikum',
            'Diplomarbeit'=>'Diplomarbeit',
            'Teilzeitstelle'=>'Teilzeitstelle',
            'Vollzeitstelle'=>'Vollzeitstelle');
        $karrierestatus = array(  'Student'=>'Student',
            'Absolvent'=>'Absolvent',
            'Doktorant'=>'Doktorant');
        echo $this->Form->input('UserProfile.einsatztermin', array('label' => 'Frühestmöglicher Einsatztermin','dateFormat' => "DMY",'type'=>'date', 'empty' => true, 'minYear' => date('Y'),  'maxYear' => date('Y')+10));
        echo $this->Form->input('UserProfile.einsatzort', array('label' => 'Gewünschter Einsatzort'));
        echo $this->Form->input('UserProfile.beschaeftigungsart', array('label' => 'Gewünschte Beschäftigungsart','options' => $beschaeftigungsart,'empty' => 'Bitte wählen'));
        echo $this->Form->input('UserProfile.karrierestatus', array('label' => 'Karrierestatus','options' => $karrierestatus,'empty' => 'Bitte wählen'));
        ?>
    </fieldset>
    <fieldset>
        <h5>Absolvierte Praktika:</h5>
        <?php
        echo $this->Form->input('UserProfile.unternehmenp1', array('label' => '1. Name und Ort des Unternehmens'));
        echo $this->Form->input('UserProfile.beginnp1', array('label' => 'Beginn','dateFormat' => "DMY",'type'=>'date', 'empty' => true, 'minYear' => date('Y')-15,  'maxYear' => date('Y')+2));
        echo $this->Form->input('UserProfile.endep1', array('label' => 'Ende','dateFormat' => "DMY",'type'=>'date', 'empty' => true, 'minYear' => date('Y')-15,  'maxYear' => date('Y')+2));
        echo $this->Form->input('UserProfile.taetigkeitp1', array('label' => 'Beschreibung der Tätigkeit'));
        ?>
        <?php
        echo $this->Form->input('UserProfile.unternehmenp2', array('label' => '2. Name und Ort des Unternehmens'));
        echo $this->Form->input('UserProfile.beginnp2', array('label' => 'Beginn','dateFormat' => "DMY",'type'=>'date', 'empty' => true, 'minYear' => date('Y')-15,  'maxYear' => date('Y')+2));
        echo $this->Form->input('UserProfile.endep2', array('label' => 'Ende','dateFormat' => "DMY",'type'=>'date', 'empty' => true, 'minYear' => date('Y')-15,  'maxYear' => date('Y')+2));
        echo $this->Form->input('UserProfile.taetigkeitp2', array('label' => 'Beschreibung der Tätigkeit'));
        ?>
        <?php
        echo $this->Form->input('UserProfile.unternehmenp3', array('label' => '3. Name und Ort des Unternehmens'));
        echo $this->Form->input('UserProfile.beginnp3', array('label' => 'Beginn','dateFormat' => "DMY",'type'=>'date', 'empty' => true, 'minYear' => date('Y')-15,  'maxYear' => date('Y')+2));
        echo $this->Form->input('UserProfile.endep3', array('label' => 'Ende','dateFormat' => "DMY",'type'=>'date', 'empty' => true, 'minYear' => date('Y')-15,  'maxYear' => date('Y')+2));
        echo $this->Form->input('UserProfile.taetigkeitp3', array('label' => 'Beschreibung der Tätigkeit'));
        ?>
    </fieldset>
    <fieldset>
        <h5>Sprachkenntnisse:</h5>
        <?php
        $kenntnisse = array(  'Muttersprache'=>'Muttersprache',
            'Fließend'=>'Fließend',
            'Grundkenntnisse'=>'Grundkenntnisse');
        echo $this->Form->input('UserProfile.sprache1', array('label' => '1. Sprache'));
        echo $this->Form->input('UserProfile.sprache1kenntnisse', array('label' => 'Kenntnisse','options' => $kenntnisse,'empty' => 'Bitte wählen'));
        ?>
        <?php
        echo $this->Form->input('UserProfile.sprache2', array('label' => '2. Sprache'));
        echo $this->Form->input('UserProfile.sprache2kenntnisse', array('label' => 'Kenntnisse','options' => $kenntnisse,'empty' => 'Bitte wählen'));
        ?>
        <?php
        echo $this->Form->input('UserProfile.sprache3', array('label' => '3. Sprache'));
        echo $this->Form->input('UserProfile.sprache3kenntnisse', array('label' => 'Kenntnisse','options' => $kenntnisse,'empty' => 'Bitte wählen'));
        ?>
        <?php
        echo $this->Form->input('UserProfile.sprache4', array('label' => '4. Sprache'));
        echo $this->Form->input('UserProfile.sprache4kenntnisse', array('label' => 'Kenntnisse','options' => $kenntnisse,'empty' => 'Bitte wählen'));
        ?>
        <?php
        echo $this->Form->input('UserProfile.sprache5', array('label' => '5. Sprache'));
        echo $this->Form->input('UserProfile.sprache5kenntnisse', array('label' => 'Kenntnisse','options' => $kenntnisse,'empty' => 'Bitte wählen'));
        ?>
    </fieldset>
    <fieldset>
        <h5>Sonstige Kenntnisse:</h5>
        <?php
        echo $this->Form->input('UserProfile.sonstigekenntnisse', array('label' => 'EDV, Führerschein etc.'));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Speichern')); ?>
    <div class="clear"></div>
</div>