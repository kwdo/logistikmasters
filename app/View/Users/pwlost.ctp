<?php
/**
 * View for Controller Users action pwlost
 *
 *
 * @copyright © Copyright Knochwerke Europaplatz 11 44269 Dortmund +49 (0)231 77 61 930 info@knochwerke.de
 * @link      http://www.knochwerke.de
 * @package    app.View.Users
 */
?>
<div class="content-wrapper">
    <h2>Passwort vergessen</h2>
    <p>
        Bitte gib Deine Email-Adresse an, damit wir Dir ein neues Passwort zusenden können.
    </p>

    <?php
    echo $this->Form->create('User', array('url' => array('action' => ('pwlost'))));
    echo $this->Form->input('User.email', array('label' => 'E-Mail'));
    ?>
    <p><sup style="color: #EE3322;">*</sup> Pflichtfelder</p>
    <?php
    echo $this->Form->end('Passwort anfordern');
    ?>
</div>
