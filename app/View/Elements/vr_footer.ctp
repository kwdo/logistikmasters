<div id="boxes">
    <div class="rectangleBox">
        <!-- Beginning Sync AdSlot 1 for Ad unit GE-B2B-VERKEHRSRUNDSCHAU/logistik_masters ### size: [[300,250],[300,500],[300,600]]  -->
        <div id='div-gpt-ad-253562757510569145-1'>
            <script type='text/javascript'>
                googletag.display('div-gpt-ad-253562757510569145-1');
            </script>
        </div>
        <!-- End AdSlot 1 -->
    </div>
    <div class="box freitext loginBox">
        <?php if (AuthComponent::user('id')): ?>
            <h3>Benutzerdaten</h3>
            <div class="content">
                Eingeloggt als <strong><?php echo AuthComponent::user('username') ?></strong>

                <div class="clear"></div>
            </div>
            <div class="wrapperNoTop">
                <?php if (AuthComponent::user('role') == 'admin'): ?>
                    <a href="/admin" class="btn-white"><span>Admin</span></a>
                <?php endif; ?>
                <a href="/users/edit" class="btn-white"><span>Profil bearbeiten</span></a>
                <a href="/users/logout" class="btn-white right"><span>Logout</span></a>

                <div class="clear"></div>
            </div>
        <?php else: ?>
            <h3>Login</h3>
            <form action="/users/login" method="post" id="loginForm" accept-charset="utf-8">
                <div class="content">
                    <table class="default-form spacertop">
                        <tr>
                            <td>
                                <b>E-Mail</b>
                            </td>
                            <td>
                                <input type="text" class="styledInput" name="data[User][email]"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>Passwort</b>
                            </td>
                            <td>
                                <input type="password" class="styledInput" name="data[User][password]"/>
                            </td>
                    </table>

                    <input type="hidden" value="/forum/" name="url"/>
                    <hr class="spacertop"/>
                    <div class="pb-10">
                        <a href="/registrieren" class="btn-white"><span>Registrieren</span></a>
                        <button class="btn-white right" type="submit" style="float:right; cursor:pointer;">
                            <span>Login</span></button>
                        <div class="clear"></div>
                    </div>

                    <div id="remember-me-wrapper"><input type="checkbox" id="remember-me" name="data[User][remember_me]"
                                                         value="1"/> <label for="remember-me" id="remember-me-label">Angemeldet
                            bleiben</label></div>
                    <a href="/users/pwlost" class="blueLink" style="display: block;">Passwort
                        vergessen?</a>


                    <div class="clear"></div>
                </div>

            </form>
        <?php endif; ?>
    </div>

    <div class="box navi3 lm">

        <ul class="nav3">
            <?php $navi = $this->Session->read('Navi'); ?>
            <li class="id1177937 <?php if ($navi == 'Home'): ?> active<?php endif; ?>">
                <a href="/">Home</a>
            </li>
            <li class="id1035140 <?php if ($navi == 'Forms'): ?> active<?php endif; ?>">

                <a href="/forms">Fragebögen</a>
            </li>
            <?php if (!AuthComponent::user('id')): ?>
                <li class="id1038446 <?php if ($navi == 'Users'): ?> active<?php endif; ?>">
                    <a href="/registrieren">Registrieren</a>
                </li>
            <?php endif; ?>
            <li class="id1035552 <?php if ($navi == 'Wettbewerb'): ?> active<?php endif; ?>">
                <a href="/wettbewerb">Wettbewerb</a>
            </li>
            <li class="id1035230 <?php if ($navi == 'Preise'): ?> active<?php endif; ?>">
                <a href="/preise">Preise</a>
            </li>
            <li class="id1092359 <?php if ($navi == 'Sponsoren'): ?> active<?php endif; ?>">
                <a href="/sponsoren">Sponsoren</a>
            </li>
            <li class="id1035228 <?php if ($navi == 'Teilnahmebedingungen'): ?> active<?php endif; ?>">
                <a href="/regeln-und-punktevergabe">Regeln und Punktevergabe</a>
            </li>
            <li class="id1035125 <?php if ($navi == 'Forum'): ?> active<?php endif; ?>">

                <a href="/forum/">Forum</a>
            </li>
            <li class="id1035236 <?php if ($navi == 'FAQ'): ?> active<?php endif; ?>">
                <a href="/faq">FAQ</a>
            </li>
            <li class="id1035234  <?php if ($navi == 'Professoren'): ?> active<?php endif; ?>">
                <a href="/professoren">Professoren</a>
            </li>
            <li class="id1035233 <?php if ($navi == 'Hochschulen'): ?> active<?php endif; ?>">
                <a href="/hochschulen">Hochschulen</a>
            </li>
            <li class="id1035289 <?php if ($navi == 'Hochschulranking'): ?> active<?php endif; ?>">
                <a href="/hochschulranking">Hochschulranking</a>
            </li>
            <li class="id1554512">
                <a href="/katalog2016">Recruiting-Katalog 2016</a>
            </li>
            <li class="id1035231 <?php if ($navi == 'LOESUNGEN'): ?> active<?php endif; ?>">
                <a href="/loesungen-aller-wettbewerbe">Lösungen (aller Wettbewerbe)</a>
            </li>
        </ul>
    </div>
    <?php if (AuthComponent::user('id')): ?>
        <div class="box loginBox">

            <h3>Freunde empfehlen</h3>

            <div class="content blue friendRecommend">
                <p><?php echo(!empty($GLOBALS['controlArticle']['friends_headline']) ? $GLOBALS['controlArticle']['friends_headline'] : ''); ?></p>

                <form action="/friends/send" method="post" id="friend" accept-charset="utf-8">
                    <table class="default-form spacertop">
                        <tr>
                            <td>
                                <b>E-Mail Ihres Freundes</b>
                            </td>
                        </tr>
                        <td>
                            <input name="data[Friend][email]" type="text" value="" id="FriendEmail"
                                   class="styledInput"/>
                        </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top">
                                <b>Text</b>
                            </td>
                        </tr>
                        <tr>
                            <td>
								<textarea name="data[Friend][message]" cols="20" rows="10" id="FriendMessage"
                                          class="styledInput light"><?php echo(!empty($GLOBALS['controlArticle']['friends_text']) ? $GLOBALS['controlArticle']['friends_text'] : ''); ?></textarea>
                            </td>
                        </tr>
                    </table>


                    <button type="submit" value="Absenden" class="btn-white right"><span>Absenden</span></button>

                    <div class="clearBoth"></div>
                </form>
            </div>
        </div>
    <?php endif; ?>
    <?php echo $this->element('boxes', array('cache' => array('key' => 'boxes', 'time' => '+1 hour'))); ?>
</div>
<div class="clear"></div>