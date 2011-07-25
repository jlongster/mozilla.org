<?php

$body_id    = 'home';
$body_class = 'locale-'.$lang;

if(!isset($meta_description)) { $meta_description = ''; }
if(!isset($extra_headers))    { $extra_headers = ''; }

$extra_headers .= <<<EXTRA_HEADERS
    <meta name="description" content="{$meta_description}" />
    <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/home.css" media="screen" />
EXTRA_HEADERS;


// Download box code for locales
$downloadbox  = '<script type="text/javascript" src="/js/download.js"></script>';
$downloadbox .= $thunderbirdDetails->getDownloadBlockForLocale($lang,  array('ancillary_links' => true, 'download_product' => 'Free Download') );

@include_once "{$config['file_root']}/includes/l10n/header.inc.php";

?>
