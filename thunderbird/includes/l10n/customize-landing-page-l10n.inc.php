<?php

$body_id    = 'landing-page';
$body_class = 'locale-'.$lang;

if(!isset($meta_description)) {$meta_description = '';}
if(!isset($extra_headers)) {$extra_headers = '';}

$extra_headers .= <<<EXTRA_HEADERS
    <meta name="description" content="{$meta_description}" />
EXTRA_HEADERS;

// Download box code for locales
$downloadbox  = '<script type="text/javascript" src="/js/download.js"></script>';
$downloadbox .= $thunderbirdDetails->getDownloadBlockForLocale($lang,  array('ancillary_links' => false, 'download_product' => 'Free Download') );

@include_once "{$config['file_root']}/includes/l10n/header.inc.php";

?>
