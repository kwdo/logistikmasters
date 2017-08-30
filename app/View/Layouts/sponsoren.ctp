<?php
//ini_set('display_errors', 1);
$sourcePage = 'https://www.verkehrsrundschau.de';
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

$cakeDom = new DOMDocument();
$cakeDom->loadHTML
(
    mb_convert_encoding($this->Session->flash(), 'ISO-8859-15')
    . mb_convert_encoding($this->Session->flash('auth'), 'ISO-8859-15')
    . mb_convert_encoding($this->fetch('content'), 'ISO-8859-15')
);

$contentWrapper = $dom->createElement('div');
$contentWrapper->setAttribute('id', 'content');
$contentWrapper->appendChild($dom->importNode($cakeDom->documentElement, true));
$mainframe->appendChild($contentWrapper);

$cakeDom = new DOMDocument();
$cakeDom->loadHTML(utf8_decode($this->element('vr_footer', ['oldPage' => $oldPage])) );
$boxesWrapper = $dom->createElement('div');
$boxesWrapper->setAttribute('id', 'boxes');
$boxesWrapper->appendChild($dom->importNode($cakeDom->documentElement, true));
$mainframe->appendChild($boxesWrapper);

$body->appendChild($footer);

insertCss($dom, '/css/vr.css');
insertCss($dom, '/js/jcarousel/skins/vr/skin.css');
insertCss($dom, '/css/studenten.css');

insertJavaScript($dom, '/js/compiled/main-2017-08-21.js');
insertJavaScript($dom, '/js/ContentFlow/contentflow.js');
insertJavaScript($dom, '/js/patches.js');

//$dom->getElementsByTagName('base')->item(0)->setAttribute('href', 'http://develop.bestazubi.de');

// Output
$dom->formatOutput = true;
$html = $dom->saveHTML();

// Transform old /fm to /sixcms/media.php
$html = str_replace(array('"/fm/','<html>','<body>','</html>','</body>','<footer'), array('"' . $oldPage . '/sixcms/media.php/','','','','','</div><footer'), $html);

echo $html;
