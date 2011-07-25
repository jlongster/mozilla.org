<?php

$body_id    = 'home';
$body_class = 'locale-'.$lang;

if(!isset($meta_description)) { $meta_description = ''; }
if(!isset($extra_headers))    { $extra_headers = ''; }


$extra_headers .= <<<EXTRA_HEADERS
  <meta name="description" content="{$meta_description}" />
EXTRA_HEADERS;

// Download box code for locales
$downloadbox  = '<script type="text/javascript" src="/thunderbird/js/download.js"></script>';
$downloadbox .= $thunderbirdDetails->getDownloadBlockForLocale($lang,  array('ancillary_links' => true, 'download_product' => 'Thunderbird', 'layout' => 'subpage') );
$downloadbox .= $thunderbirdDetails->getNoScriptBlockForLocale($lang,  array('ancillary_links' => true, 'download_product' => 'Thunderbird', 'layout' => 'subpage') );

$menuitems= array(
  0 => 'Thunderbird',
  1 => ___('Features'),
  2 => ___('Release Notes'),
  3 => ___('Other Systems and Languages')
);

$latestversion = LATEST_THUNDERBIRD_VERSION;

$sidemenu = <<<EXTRA_HEADERS
<ul id="side-menu">
    <li class="first"><h3><span>{$menuitems[0]}</span></h3></li>
    <li><a href="/{$lang}/thunderbird/features/">{$menuitems[1]}</a></li>
    <li><a href="/{$lang}/thunderbird/{$latestversion}/releasenotes/">{$menuitems[2]}</a></li>
    <li><a href="/{$lang}/thunderbird/all.html">{$menuitems[3]}</a></li>
</ul>
EXTRA_HEADERS;

$jscall = <<<JS_CALL
<script type="text/javascript">
// <![CDATA[
// ]]>
</script>
JS_CALL;

@include_once "{$config['file_root']}/includes/l10n/header.inc.php";

?>
