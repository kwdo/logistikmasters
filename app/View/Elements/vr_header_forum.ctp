<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
    <link rel="shortcut icon" href="favicon.ico" >
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="VerkehrsRundschau, Verlag Heinrich Vogel, Springer Fachmedien München" />
    <meta name="apple-itunes-app" content="app-id=682258694">
    <meta name="google-play-app" content="app-id=com.springer.vrepaper">
    <meta name="description" content="VerkehrsRundschau.de ist das Portal für die Transport-, Speditions- und Logistik-Branche. Die tagesaktuellen Nachrichten, Schwerpunktthemen und Bildergalerien richten sich an Carrier, Speditionen, Logistikdienstleister und Werksverkehrsunternehmen sowie Logistiker in Industrie und Handel und bei Kurier-, Express- und Postdiensten." /><meta name="keywords" content="verkehrsrundschau, transport, logistik" /><meta name="Web-Traffic" content="category: ; onlineDate: 01.01.2002; offlineDate: ; creationDate: " /> 	 			<link rel="alternate" type="application/rss+xml" title="verkehrsrundschau.de als RSS-Feed" href="http://feeds.feedburner.com/Verkehrsrundschaude-Nachrichten" />
    <title><?php echo $title_for_layout; ?></title>
    <?php
    echo $this->Html->css('/forum/css/base.css');
    echo $this->Html->css('/forum/css/style.css');
    echo $this->Html->script('/forum/js/forum.js');

    if ($this->params['controller'] == 'home') {
        echo $this->Html->meta(__d('forum', 'RSS Feed - Latest Topics'), array('action' => 'feed', 'ext' => 'rss'), array('type' => 'rss'));
    } else if (isset($rss) && in_array($this->params['controller'], array('stations', 'topics'))) {
        echo $this->Html->meta(__d('forum', 'RSS Feed - Content Review'), array('action' => 'feed', $rss, 'ext' => 'rss'), array('type' => 'rss'));
    }
     ?>
    <?php
    echo $this->Html->meta('icon');
    echo $this->Html->css('cake.frontend');

    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js');
    echo $this->fetch('script');
    ?>
    <meta property="og:image" content="http://www.verkehrsrundschau.de/images/og-image.png">
    <link type="text/css" href="http://www.verkehrsrundschau.de/css/jquery.jscrollpane.css" rel="stylesheet" media="all" />
    <link rel="stylesheet" type="text/css" href="http://www.verkehrsrundschau.de/css/custom-theme-vr/jquery-ui-1.8.13.custom.css" />
    <link rel="stylesheet" type="text/css" href="http://www.verkehrsrundschau.de/css/styles.css" />
    <link rel="stylesheet" type="text/css" href="http://www.verkehrsrundschau.de/css/print_styles.css" media="print" />
    <link rel="stylesheet" type="text/css" href="http://www.verkehrsrundschau.de/sixcms/detail.php?template=vkr_dossiers_css" />
    <link rel="stylesheet" type="text/css" href="http://www.verkehrsrundschau.de/js/jcarousel/skins/vrBildslider/skin.css" />
    <link rel="stylesheet" type="text/css" href="http://www.verkehrsrundschau.de/js/jcarousel/skins/vrArtikelBilder/skin.css" />
    <!--[if IE 6]><link rel="stylesheet" type="text/css" href="http://www.verkehrsrundschau.de/css/ie6_styles.css" />  <![endif]-->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://www.verkehrsrundschau.de/js/jquery.jscrollpane.min.js"></script>
    <script type="text/javascript" src="http://www.verkehrsrundschau.de/js/jcarousel/lib/jquery.jcarousel.min.js"></script>
    <script type="text/javascript" src="http://www.verkehrsrundschau.de/js/vr_functions.js"></script>
    <script type="text/javascript" src="http://www.verkehrsrundschau.de/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="http://www.verkehrsrundschau.de/js/jquery.fontscale.js"></script>
    <script type="text/javascript" src="http://www.verkehrsrundschau.de/js/superfish/js/hoverIntent.js"></script>
    <script type="text/javascript" src="http://www.verkehrsrundschau.de/js/superfish/js/superfish.js"></script>
    <script type="text/javascript" src="http://www.verkehrsrundschau.de/js/superfish/js/supersubs.js"></script>
	<script type="text/javascript" src="https://script.ioam.de/iam.js"></script>
	<script type="text/javascript">
        window.cookieconsent_options = {"message":"Mit der Nutzung dieser Website erklären Sie sich mit unserer Verwendung von Cookies einverstanden.","dismiss":"Verstanden","learnMore":"Mehr Informationen","link":"http://www.verkehrsrundschau.de/sixcms/detail.php?template=de_datenschutz_vr","theme":"dark-bottom"};
    </script>

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.9/cookieconsent.min.js"></script>
    <?php echo $this->Html->css('azubi'); ?>
    <?php echo $scripts_for_layout; ?>
</head>
<body>
<div id="page">
    <div id="superbanner">
        <script type="text/javascript">
            if (typeof(et_ord)=='undefined')
                et_ord=Math.floor(Math.random()*10000000000000000);
            if (typeof(et_tile)=='undefined') et_tile=1;
            document.write('<scr'+'ipt language="JavaScript" src="http://ad.de.doubleclick.net/adj/GE-B2B-VERKEHRSRUNDSCHAU/best_azubi;dcopt=ist;sz=728x90;tile=' + (et_tile++) + ';ord=' + et_ord + '?" type="text/javascript"></scr' + 'ipt>');
        </script>
    </div>
    <div id="pre-header">
    <ul id="infonavi">
        <li><a href="abo-bestellen-1032847.html" >Abo-Angebote</a></li>
        <li><a href="/newsletter-1025513.html" >Newsletter</a></li>
        <li><a href="http://www.heinrich-vogel-shop.de/transport-logistik.html" target="_blank">Shop</a></li>
        <li><a href="/e-paper-heft-archiv-1200554.html" >E‐Paper / Heft‐Archiv</a></li>
        <li><a href="http://www.verkehrsrundschau.de/mobil-1288396.html" >Mobil</a></li>
        <li><a href="http://vhv.mediacentrum.de/site/index.html" target="_blank">Mediadaten</a></li>
        <li><a href="/ueber-uns-1025521.html" >Über uns</a></li>
        <li><a href="/kontakt-1025522.html" >Kontakt</a></li>
        <li><a href="/rubrikanzeigen-1025520.html" >Rubrikanzeigen</a></li>
    </ul>
	<div id="dateHeader">
		<?php
			setlocale(LC_TIME, 'de_DE');
			echo utf8_encode(strftime('%A, %d. %B %Y'));
		?>
	</div>
	<!-- AddThis Button BEGIN -->
    <div class="addthis_toolbox addthis_default_style">
        <a class="addthis_button_facebook"></a>
        <a class="addthis_button_twitter"></a>
        <a class="rssIcon" href="http://www.verkehrsrundschau.de/feeds/nachrichten.xml"><img src="/img/rss.png" /></a>
    </div>

    <!-- AddThis Button END -->
    </div>
    <div id="header">
        <div id="skyscraper">
            <script type="text/javascript">
                if (typeof(et_ord)=='undefined') et_ord=Math.floor(Math.random()*10000000000000000);
                if (typeof(et_tile)=='undefined') et_tile=1;
                document.write('<scr'+'ipt language="JavaScript" src="http://ad.de.doubleclick.net/adj/GE-B2B-VERKEHRSRUNDSCHAU/transport;sz=120x600,160x600;tile=' + (et_tile++) + ';ord=' + et_ord + '?" type="text/javascript"></scr' + 'ipt>');
            </script>
        </div>
        <a href="/" id="logo"></a>
        <div id="login">
            <a href="/vr/1025473?login" class="login">Login</a>
            <a href="https://registrierung.springerfachmedien-muenchen.de/app/index?theme=VHV" class="register">| Neu registrieren!</a>
        </div>         				<div id="search">
            <form method="post" action="/suche">
                <input type="text" name="search[query]" value="Volltextsuche" onfocus="if(this.value==defaultValue)this.value='';" id="_query" type="text" /><input type="image" id="searchbutton" src="/img/search.png" alt="Suchen" />
            </form>
            <ul id="mininavi">
                <li><a href="/stellenboerse-1025502.html" >Stellenmarkt</a></li>
                <li><a href="http://www.verkehrsrundschau.de/branchenguide-1083605.html" >Branchenguide</a></li>
                <li><a href="http://www.verkehrsrundschau.de/software-guide-1152886.html" >Softwareguide</a></li>
            </ul>		</div>
    </div>
    <ul id="topnav" class="sf-menu">
        <!--  -->
        <li class="first"><a href="/transport-logistik-1025473.html" ><span>Transport + Logistik</span></a>
            <ul>
                <li class="first"><a href="/nachrichten-1025487.html">Nachrichten</a></li><li><a href="/transportpreise-vr-index-1025489.html">Transportpreise/VR-Index</a></li><li><a href="/insolvenzdatenbank-1025490.html">Insolvenzdatenbank</a></li><li><a href="/lkw-fahrverbote-1025491.html">LKW-Fahrverbote</a></li><li><a href="/image-ranking-1095517.html">Image-Ranking</a></li><li><a href="/marktuebersichten-1039037.html">Marktübersichten</a></li><li><a href="/dossiers-1039029.html">Dossiers</a></li><li><a href="/studien-dokumente-1039015.html">Studien + Dokumente</a></li><li class="last"><a href="http://www.verkehrsrundschau.de/branchenguide-1083605.html">Branchenguide</a></li></ul>	</li>
        <!--  -->
        <li><a  ><span>Lager + Umschlag</span></a>
            <ul>
                <li class="first"><a href="/nachrichten-1025492.html">Nachrichten</a></li><li><a href="/marktuebersichten-1039039.html">Marktübersichten</a></li><li><a href="/stapler-test-1121716.html">Stapler-Test</a></li><li><a href="/image-ranking-1095525.html">Image-Ranking</a></li><li><a href="/dossiers-1039031.html">Dossiers</a></li><li><a href="/studien-dokumente-1039014.html">Studien + Dokumente</a></li><li class="last"><a href="http://www.verkehrsrundschau.de/branchenguide-1083605.html">Branchenguide</a></li></ul>	</li>
        <!--  -->
        <li><a  ><span>NFZ + Fuhrpark</span></a>
            <ul>
                <li class="first"><a href="/nachrichten-1025493.html">Nachrichten</a></li><li><a href="/umweltranking-1078542.html">Umweltranking</a></li><li><a href="/nutzfahrzeugkatalog-1062216.html">Nutzfahrzeugkatalog</a></li><li><a href="/nutzfahrzeuge-bilder">Bildergalerien</a></li><li><a href="/testdatenbank-1025495.html">Testdatenbank</a></li><li><a href="/image-ranking-1095529.html">Image-Ranking</a></li><li><a href="/marktuebersichten-1039040.html">Marktübersichten</a></li><li><a href="/dossiers-1039032.html">Dossiers</a></li><li><a href="/studien-dokumente-1039012.html">Studien + Dokumente</a></li><li class="last"><a href="http://www.verkehrsrundschau.de/branchenguide-1083605.html">Branchenguide</a></li></ul>	</li>
        <!--  -->
        <li><a  ><span>Recht + Geld</span></a>
            <ul>
                <li class="first"><a href="/nachrichten-urteile-1025497.html">Nachrichten + Urteile</a></li><li><a href="/lenk-und-ruhezeiten-1233082.html">Lenk- und Ruhezeiten</a></li><li><a href="/rechtsformular/">Rechtsberatung</a></li><li><a href="/marktuebersichten-1039041.html">Marktübersichten</a></li><li><a href="/dossiers-1039033.html">Dossiers</a></li><li class="last"><a href="/studien-dokumente-1039016.html">Studien + Dokumente</a></li></ul>	</li>
        <!--  -->
        <li class="active"><a ><span>Ausbildung + Karriere</span></a>
            <ul>
                <li class="first"><a href="/nachrichten-1025499.html">Nachrichten</a></li><li><a href="http://hallo-zukunft.info/" target="_blank">Hallo, Zukunft!</a></li><li ><a href="/bestazubi">Best Azubi</a></li><li class="active"><a href="/logistik-masters-1025501.html">LOGISTIK MASTERS</a></li><li><a href="/youloc-1170590.html">YouLoC</a></li><li><a href="/stellenmarkt-1025502.html">Stellenmarkt</a></li><li><a href="/marktuebersichten-1039042.html">Marktübersichten</a></li><li><a href="/dossiers-1039035.html">Dossiers</a></li><li><a href="/studien-dokumente-1039018.html">Studien + Dokumente</a></li><li class="last"><a href="http://www.verkehrsrundschau.de/branchenguide-1083605.html">Branchenguide</a></li></ul>	</li>
        <!--  -->
        <li><a  ><span>Veranstaltungen</span></a>
            <ul>
                <li class="first"><a href="/nachrichten-1025503.html">Nachrichten</a></li><li><a href="/verlagsveranstaltungen-1025504.html">Verlagsveranstaltungen</a></li><li><a href="/termine-1025505.html">Termine</a></li><li class="last"><a href="/aufzeichnung-webinare-1055857.html">Aufzeichnung Webinare</a></li></ul>	</li>
        <!--  -->
        <li class="last"><a  ><span>Services</span></a>
            <ul>
                <li class="first"><a href="/wochenrueckblick-1025486.html">Wochenrückblick</a></li><li><a href="/aktuell-bilder">Bilder</a></li><li><a href="/videos">Videos</a></li><li><a href="/lexikon-1025507.html">Lexikon</a></li><li><a href="/dossiers-1025509.html">Dossiers</a></li><li class="last"><a href="/studien-dokumente-1025511.html">Studien + Dokumente</a></li></ul>	</li>
            </ul>
    <script type="text/javascript">
        $(document).ready(function(){
            $("ul#topnav").supersubs({
                minWidth:    12,
                maxWidth:    50,
                extraWidth:  1
            }).superfish({autoArrows:  false});
        });
    </script>
    <div id="contentWrapper">
        <div id="breadcrumb">
            &rsaquo; <a href="http://www.verkehrsrundschau.de/">Home</a>
            &rsaquo; <a href="http://www.verkehrsrundschau.de/karriere-1025478.html">Karriere</a> &rsaquo; <a href="/">Logistik Masters</a> &rsaquo; <?php echo $this->element('breadcrumbs'); ?>
        </div>
        <div id="mainframe2">
            <div id="billboard">
                <script type="text/javascript">
                    if (typeof(et_ord)=="undefined")
                        et_ord=Math.floor(Math.random()*10000000000000000);
                    if (typeof(et_tile)=="undefined") et_tile=1;
                    document.write('<scr'+'ipt language="JavaScript" src="http://ad.de.doubleclick.net/adj/GE-B2B-VERKEHRSRUNDSCHAU/logistik_masters;sz=770x250,800x250,900x250,950x250,970x250;tile=' + (et_tile++) + ';ord=' + et_ord + '?" type="text/javascript"></scr' + 'ipt>');
  
                </script>
            </div>
            <div id="mainframe" class="azubi">
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
