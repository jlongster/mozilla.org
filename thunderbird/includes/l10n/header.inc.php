<?php

// Build our dynamic header
$ltr = array('ar', 'fa', 'he');

$page_title    = empty($page_title)    ? 'Mozilla Thunderbird' : $page_title;
$textdir       = in_array($lang, $ltr) ? 'rtl'                  : 'ltr';
$extra_headers = empty($extra_headers) ? ''                     : $extra_headers;
$breadcrumbs   = !isset($breadcrumbs)  ? array()                : $breadcrumbs;
$search_button = ___('Search');
	if ($textdir == 'rtl') {
        $extra_headers .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"{$config['static_prefix']}/style/tb5/rtl.css\" media=\"screen\" />";
    }
$dynamic_header = <<<DYNAMIC_HEADER
<!DOCTYPE HTML>

<html xml:lang="{$lang}" lang="{$lang}" dir="{$textdir}">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <title>{$page_title}</title>
  <script type="text/javascript" src="{$config['static_prefix']}/js/util.js"></script>
  <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/tb5/content.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/tb5/template.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/tb5/home.css" media="screen" />
    {$extra_headers}
</head>

<body id="{$body_id}" class="{$body_class}">

<script type="text/javascript">// <![CDATA[
// add classes to body to indicate browser version and JavaScript availabiliy
if (document.body.className == '') {
  document.body.className = 'js';
} else {
  document.body.className += ' js';
}

if (gPlatform == 1) {
  document.body.className += ' platform-windows';
} else if (gPlatform == 3 || gPlatform == 4) {
  document.body.className += ' platform-mac';
} else if (gPlatform == 2) {
  document.body.className += ' platform-linux';
}

// ]]></script>

<div id="breadcrumbs">
    {$_breadcrumb_link_string}
</div>

<noscript><div id="no-js-feature"></div></noscript>

<div id="wrapper">
<div id="doc">

 <div id="nav-access">
    <a href="#nav-main">{$l10n->get('skip to Navigation')}</a>
    <a href="#lang_form">{$l10n->get('switch language')}</a>
 </div>

 <!-- start menu #nav-main -->
<div id="header">
    <h1><a href="/{$lang}/thunderbird/" title="{$l10n->get('Back to home page')}"><img src="{$config['static_prefix']}/img/template/header/logo.png" height="56" width="235" alt="Mozilla Thunderbird" /></a></h1>
    <div id="nav-main" role="navigation">
        <ul role="menubar">
            <li id="nav-main-features" class="first"><a href="/{$lang}/thunderbird/features/">{$l10n->get('Features')}</a></li>
            <li id="nav-main-addons"><a href="https://addons.mozilla.org/thunderbird/">{$l10n->get('Add-Ons')}</a></li>
            <li id="nav-main-support"><a href="http://support.mozillamessaging.com/">{$l10n->get('Support')}</a></li>
            <li id="nav-main-about" class="last"><a href="http://www.mozilla.org/about/">{$l10n->get('About')}</a></li>
        </ul>
    </div>
    <a class="mozilla" href="http://www.mozilla.org/">mozilla</a>
</div>
        <!-- end menu #nav-main -->
  <hr class="hide" />

DYNAMIC_HEADER;

echo $dynamic_header;
?>
