<h1>Willkommen zurück bei Logistik Masters!</h1>
<p>Um Dein Profil aus dem vergangenen Jahr zu reaktivieren, sende Dir über den unten stehenden Button unseren Reaktivierungs-Link zu und klicke anschließend darauf - und schon bist du wieder dabei.</p>
<p>Viel Erfolg beim Wettbewerb wünscht das Logistik Masters Team.</p>


<?php echo $this->Form->postLink(
    '<span>Aktivierungslink zusenden</span>',
    array('action' => 'doubleoptin_rsnd', $user['User']['id']),
    array('escape' => false,'class'=>'btn-white')
); ?>
