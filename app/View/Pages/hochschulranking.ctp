<?php
$html = $this->element('http_fetcher', array('url' => 'http://www.verkehrsrundschau.de/sixcms/detail.php?id=1191755&template=vkr_hochschulranking'));

$dom = new DOMDocument();
libxml_use_internal_errors(true);
$dom->loadHTML(mb_convert_encoding($html, 'ISO-8859-15'));
libxml_clear_errors();

foreach ($dom->getElementsByTagName('a') as $tag)
{
    $href = $tag->getAttribute('href');
    if($href && empty(parse_url($href, PHP_URL_SCHEME)))
    {
        $prefix = '/' === substr($href, 0, 1) ? '' : '/';
        $tag->setAttribute('href', 'https://www.verkehrsrundschau.de/nachrichten' . $prefix . $href);
    }
}

echo $dom->saveHTML();
