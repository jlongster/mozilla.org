<?php
    // Build our dynamic header

    $page_title    = empty($page_title)    ? 'Mozilla Thunderbird' : $page_title;
    $textdir       = empty($textdir)       ? 'ltr'         : $textdir;
    $extra_headers = empty($extra_headers) ? ''            : $extra_headers;
    $breadcrumbs   = !isset($breadcrumbs)  ? array()       : $breadcrumbs;
	$search_button = ___('Search');

$dynamic_header = <<<DYNAMIC_HEADER
<!DOCTYPE html>

<html xml:lang="{$lang}" lang="{$lang}" dir="{$textdir}">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<title>{$page_title}</title>
	<script type="text/javascript" src="{$config['static_prefix']}/js/util.js"></script>
        <link rel="shortcut icon" type="image/ico" href="/thunderbird/img/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/tb5/template.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="{$config['static_prefix']}/style/tb5/content.css" media="screen" />
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

	<!-- start #header -->
	<div id="header">
		<div>
		<h1><a href="/{$lang}/thunderbird/" title="{$l10n->get('Back to home page')}"><img src="{$config['static_prefix']}/img/template/header/logo.png" height="56" width="235" alt="Mozilla Thunderbird" /></a></h1>
		{$dynamic_top_menu}
		<a class="mozilla" href="http://www.mozilla.org/">mozilla</a>
		</div>
		
	</div>
	<!-- end #header -->

	<hr class="hide" />

DYNAMIC_HEADER;
