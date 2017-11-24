<div id="boxes">
    <div class="rectangleBox">
        <div id='Ad_Rectangle1'>
            <script>
              googletag.display('Ad_Rectangle1');
            </script>
        </div>
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
                <a href="/katalog2017">Recruiting-Katalog 2017</a>
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
</div>
</div>
</section>
<div class="clear"></div>
<footer class="vr-foot vr-home-foot"><div style="display:none;">
    <span itemprop="author publisher" itemscope itemtype="http://schema.org/Organization">
                <span itemprop="name"><a itemprop="url" href="https://www.verkehrsrundschau.de">VerkehrsRundschau</a></span>
                <span itemprop="telephone">+49 89 2030431100</span>
                                <div itemprop="logo" itemscope itemtype="http://schema.org/ImageObject">
                    <img itemprop="url" src="https://www.verkehrsrundschau.de/media/cache/my_strip_filter/sixcms/media.php/1768/vr_logo.png" width="1000px" height="588px"><span itemprop="width">1000px</span>
                    <span itemprop="height">588px</span>
                </div>
                            </span>
    </div>
    <div class="wrap">
        <div class="container container--alt">
            <ul class="nav-social visible-xs">
                <li>
                    <a href="#">
                        <span class="fa fa-facebook-f"></span>
                        <span class="sr-only">Facebook</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="fa fa-twitter"></span>
                        <span class="sr-only">Twitter</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="fa fa-youtube"></span>
                        <span class="sr-only">YouTube</span>
                    </a>
                </li>


                <li>
                    <a href="https://www.facebook.com/verkehrsrundschau" target="_blank">
                        <span class="fa fa-facebook-f"></span>
                        <span class="sr-only">Facebook</span>
                    </a>
                </li>
                <li>
                    <a href="https://twitter.com/vr_online" target="_blank">
                        <span class="fa fa-twitter"></span>
                        <span class="sr-only">Twitter</span>
                    </a>
                </li>
                <li>
                    <a href="https://www.youtube.com/user/VerkehrsRundschau" target="_blank">
                        <span class="fa fa-youtube"></span>
                        <span class="sr-only">YouTube</span>
                    </a>
                </li>
            </ul>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-sm-5 js-home-footer-col">
                    <div class="vertical-parent">
                        <div class="vertical-child">
                            <ul class="nav-social hidden-xs">
                                <li>
                                    <a href="https://www.facebook.com/verkehrsrundschau" target="_blank">
                                        <span class="fa fa-facebook-f"></span>
                                        <span class="sr-only">Facebook</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/vr_online" target="_blank">
                                        <span class="fa fa-twitter"></span>
                                        <span class="sr-only">Twitter</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.youtube.com/user/VerkehrsRundschau" target="_blank">
                                        <span class="fa fa-youtube"></span>
                                        <span class="sr-only">YouTube</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7 js-home-footer-col">
                    <form action="https://registrierung.springerfachmedien-muenchen.de/app/index?execution=e2s1" id="NewsletterFooterForm" target="_blank">
                        <div class="vr-foot__newsletter">
                            <h2 class="vr-foot__heading vr-foot__heading--newsletter hidden-xs">Newsletter</h2>
                            <div class="input-group vr-foot__form">
                                <input type="email" name="email" class="form-control" placeholder="E-mail adresse"><span class="input-group-btn">
                                    <button class="btn btn-newsletter" onclick="document.getElementById('NewsletterFooterForm').submit();">
                                      <span class="vr-icon--envelope"></span>
                                      <span class="sr-only">Senden</span>
                                    </button>
                                  </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <!-- begin src/AppBundle/Resources/views/Navigation/navigation_footernavi.html.twig --><ul class="nav-legal" itemscope itemtype="http://schema.org/SiteNavigationElement">
                <li><a href="https://www.verkehrsrundschau.de/aboplus/vr-abo-1733583.html">
                        Abo-Angebote
                    </a></li>
                <li><a href="https://www.heinrich-vogel-shop.de/index.html?utm_source=VR%20Website&amp;utm_medium=Hauptnavi&amp;utm_campaign=VR_Traffic_Shop" target="_blank">
                        Shop
                    </a></li>
                <li><a href="https://www.verkehrsrundschau.de/kontakt">
                        Kontakt
                    </a></li>
                <li><a href="https://www.mediacentrum.de/sixcms/detail.php?id=1547810" target="_blank">
                        Mediadaten
                    </a></li>
                <li><a href="https://www.mediacentrum.de/sixcms/detail.php?id=1547823" target="_blank">
                        Rubrikanzeigen
                    </a></li>
                <li><a href="https://www.verkehrsrundschau.de/impressum">
                        Impressum
                    </a></li>
                <li><a href="https://www.verkehrsrundschau.de/agb">
                        AGB
                    </a></li>
                <li><a href="https://www.verkehrsrundschau.de/datenschutz">
                        Datenschutz
                    </a></li>
            </ul>
            <!-- end src/AppBundle/Resources/views/Navigation/navigation_footernavi.html.twig -->
        </div>

        <div class="springer-nature-footer springer-nature-footer-reverse">
            <div style="max-width:800px;margin:0;">
                <a class="springer-nature-footer-logo" href="http://www.springernature.com" target="_blank"></a>
                <p>© 2017 Springer Fachmedien München. Part of <a href="http://www.springernature.com" target="_blank">Springer Nature</a>.</p>
            </div>
        </div>

    </div>

</footer>

<div id="count">
    <!-- SZM VERSION="2.0" -->
    <script type="text/javascript">
        var iam_data = {
            "mg":"yes", // Migrationsmodus AKTIVIERT
            "st":"verkrund", // site/domain
            "cp":"logistikmasters", // code
            "oc":"logistikmasters" // code SZM-System 1.5
        }
        iom.c(iam_data);
    </script> <!--/SZM -->
</div>
<div id='Ad_oop'>
    <script>
      googletag.display('Ad_oop');
    </script>
</div> 