<?php

$body_id    = 'thunderbird-features';
$body_class = 'locale-'.$lang;

if(!isset($meta_description)) { $meta_description = ''; }
if(!isset($extra_headers))    { $extra_headers = ''; }

$extra_headers .= <<<EXTRA_HEADERS
  <meta name="description" content="{$meta_description}" />
  <link rel="stylesheet" href="{$config['static_prefix']}/style/tb5/features.css" media="screen" />
  <script src="{$config['static_prefix']}/js/jquery/jquery-1.5.1.min.js"></script>
EXTRA_HEADERS;

$features_downloadbox  = '<script type="text/javascript" src="/thunderbird/js/download.js"></script>';
$features_downloadbox .= '<div id="download" class="top-right">';
$features_downloadbox .= $thunderbirdDetails->getDownloadBlockForLocale($lang,  array('ancillary_links' => true, 'layout' => 'subpage', 'download_parent_override' => 'download', '_include_js' => false, 'download_product' => 'Thunderbird') );
$features_downloadbox .= '</div>';

$menuitems= array(
  0 => 'Thunderbird',
  1 => ___('Features'),
  2 => ___('Release Notes'),
  3 => ___('Other Systems and Languages')
);

$latestversion = LATEST_THUNDERBIRD_VERSION;

$sidemenu = '';

@include_once "{$config['file_root']}/includes/l10n/header.inc.php";

?>
