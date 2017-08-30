<?php echo $this->Html->script('users_add', array('block' => 'scriptBottom')); ?>
<div class="users form">
    <div class="mainHeadline">
        <img src="https://www.verkehrsrundschau.de/bestazubi/wcf/icon/azubi/registerL.png" alt="" />
        <div class="headlineContainer">
            <h2> Registrieren</h2>
        </div>
    </div>



    <?php echo $this->Session->flash(); ?>

    <?php echo $this->Form->create('User'); ?>
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
    <?php echo $this->Form->end(__('Submit')); ?>
</div>

<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('List Profiles'), array('controller' => 'profiles', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Profile'), array('controller' => 'profiles', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List User Catalogs'), array('controller' => 'user_catalogs', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New User Catalog'), array('controller' => 'user_catalogs', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List User Catalogs2011s'), array('controller' => 'user_catalogs2011s', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New User Catalogs2011'), array('controller' => 'user_catalogs2011s', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List User Catalogs Olds'), array('controller' => 'user_catalogs_olds', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New User Catalogs Old'), array('controller' => 'user_catalogs_olds', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List User Catalogs Tmps'), array('controller' => 'user_catalogs_tmps', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New User Catalogs Tmp'), array('controller' => 'user_catalogs_tmps', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List User Points'), array('controller' => 'user_points', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New User Point'), array('controller' => 'user_points', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Forms'), array('controller' => 'forms', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Form'), array('controller' => 'forms', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
    </ul>
</div>
