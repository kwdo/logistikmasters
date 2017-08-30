<?php
//ini_set('display_errors', 1);
$sourcePage = 'https://develop.verkehrsrundschau.de';
$oldPage = 'https://www.verkehrsrundschau.de';

// Get original HTML or cached version
$dom = new DOMDocument();
libxml_use_internal_errors(true);
//$html = $this->element('vr_header', array('sourcePage' => $sourcePage, 'cache'=> array('key' => 'header', 'time' => '+1 day')));
$html = $this->element('vr_header', array('sourcePage' => $sourcePage));

// Absolutize relative source URLs
// $html = str_replace('"/', '"' . $sourcePage . '/', $html);

$dom->loadHTML($html);
libxml_clear_errors();

// Extract layout
$body = $dom->getElementsByTagName('body')->item(0);
$header = $body->getElementsByTagName('header')->item(0)->cloneNode(true);
$footer = $body->getElementsByTagName('footer')->item(0)->cloneNode(true);

// Clean body
while($child = $body->firstChild)
{
    $body->removeChild($child);
}

foreach($header->getElementsByTagName('a') as $tag)
{
    $href = $tag->getAttribute('href');
    if(substr($href, 0, 1) === '/')
    {
        $tag->setAttribute('href', $sourcePage . $href);
    }
}

foreach($footer->getElementsByTagName('a') as $tag)
{
    $href = $tag->getAttribute('href');
    if(substr($href, 0, 1) === '/')
    {
        $tag->setAttribute('href', $sourcePage . $href);
    }
}

// Insert header
$body->appendChild($header);


$page = $dom->createElement('div');
$page->setAttribute('id', 'page');
$body->appendChild($page);

// Insert Content
$mainframe = $dom->createElement('div');
$mainframe->setAttribute('id', 'mainframe');
$mainframe->setAttribute('class', 'azubi');
$page->appendChild($mainframe);

$contentWrapper = $dom->createElement('div');
$contentWrapper->setAttribute('id', 'content');

$wrapper = $dom->createElement('div');
$wrapper->setAttribute('id', 'forum');

if ($user && $this->Common->hasAccess(AccessLevel::ADMIN))
{
    $divHeader = $dom->createElement('div');
    $divHeader->setAttribute('class', 'header');

    $ul = $dom->createElement('ul');
    $ul->setAttribute('class', 'menu');
    $ul->appendChild($divHeader);
    $class = ($menuTab == 'home') ? 'active' : '';

    $li = $dom->createElement('li');
    $ul->appendChild($li);
    if($menuTab == 'home') $li->setAttribute('class', 'active');
    $li->nodeValue = $this->Html->link(__d('forum', 'Home'), $settings['site_main_url']);

    $li = $dom->createElement('li');
    $ul->appendChild($li);
    if($menuTab == 'forums') $li->setAttribute('class', 'active');
    $li->nodeValue = $this->Html->link(__d('forum', 'Forums'), array('controller' => 'forum', 'action' => 'index'));

    $li = $dom->createElement('li');
    $ul->appendChild($li);
    if($menuTab == 'search') $li->setAttribute('class', 'active');
    $li->nodeValue = $this->Html->link(__d('forum', 'Search'), array('controller' => 'search', 'action' => 'index'));

    $li = $dom->createElement('li');
    $ul->appendChild($li);
    if($menuTab == 'rules') $li->setAttribute('class', 'active');
    $li->nodeValue = $this->Html->link(__d('forum', 'Rules'), array('controller' => 'forum', 'action' => 'rules'));

    $li = $dom->createElement('li');
    $ul->appendChild($li);
    if($menuTab == 'help') $li->setAttribute('class', 'active');
    $li->nodeValue = $this->Html->link(__d('forum', 'Help'), array('controller' => 'forum', 'action' => 'help'));

    $li = $dom->createElement('li');
    $ul->appendChild($li);
    if($menuTab == 'users') $li->setAttribute('class', 'active');
    $li->nodeValue = $this->Html->link(__d('forum', 'Users'), array('controller' => 'users', 'action' => 'index'));

    $span = $dom->createElement('span');
    $divHeader->appendChild($span);
    $span->setAttribute('class', 'clear');
}

$contentWrapper->appendChild($wrapper);

$cakeDom = new DOMDocument();
$cakeHtml =  mb_convert_encoding($this->element('login'), 'ISO-8859-15')
    . mb_convert_encoding($this->Session->flash(), 'ISO-8859-15')
    . mb_convert_encoding($this->Session->flash('auth'), 'ISO-8859-15')
    . mb_convert_encoding($this->fetch('content'), 'ISO-8859-15');
;
$tmpFile = tempnam('/u01/htdocs/webs/www.verkehrsrundschau.de/bestazubi_live/app/tmp/cache/forum/', null);
file_put_contents($tmpFile, $cakeHtml);
$cakeDom->loadHTMLFile($tmpFile);
unlink($tmpFile);

$contentWrapper->appendChild($dom->importNode($cakeDom->documentElement, true));
$mainframe->appendChild($contentWrapper);

$cakeDom = new DOMDocument();
$cakeDom->loadHTML(utf8_decode($this->element('vr_footer'))); // LIBXML_HTML_NODEFDTD | LIBXML_HTML_NOIMPLIED
$boxesWrapper = $dom->createElement('div');
$boxesWrapper->setAttribute('id', 'boxes');
$boxesWrapper->appendChild($dom->importNode($cakeDom->documentElement, true));
$mainframe->appendChild($boxesWrapper);

$body->appendChild($footer);

// Patch old VR styles into header
insertCss($dom, '/css/vr.css');
//insertCss($dom, '/forum/css/base.css');
//insertCss($dom, '/forum/css/style.css');
insertCss($dom, '/css/studenten.css');

insertJavaScript($dom, '/js/compiled/main-2017-08-21.js');
insertJavaScript($dom, '/forum/js/forum.js');
insertJavaScript($dom, '/js/patches.js');

//$dom->getElementsByTagName('base')->item(0)->setAttribute('href', 'http://develop.bestazubi.de');

// Output
$dom->formatOutput = true;
$html = $dom->saveHTML();

// Transform old /fm to /sixcms/media.php
//$html = str_replace('"/fm/', '"' . $oldPage . '/sixcms/media.php/', $html);
$html = str_replace(array('"/fm/','<html>','<body>','</html>','</body>','<footer'), array('"' . $oldPage . '/sixcms/media.php/','','','','','</div><footer'), $html);

echo $html;
