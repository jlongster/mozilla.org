<?php

require_once 'MozillaOrg/Breadcrumb.php';
require_once 'MozillaOrg/LeftMenu.php';
require_once 'MozillaOrg/TopMenu.php';

$html_title          = empty($html_title)          ? 'Mozilla.org' : $html_title;
$page_title          = empty($page_title)          ? ''            : $page_title;
$textdir             = empty($textdir)             ? 'ltr'         : $textdir;
$extra_headers       = empty($extra_headers)       ? ''            : $extra_headers;
$extra_js            = empty($extra_js)            ? ''            : $extra_js;
$extra_style         = empty($extra_style)         ? ''            : $extra_style;
$body_id             = empty($body_id)             ? ''            : $body_id;
$body_class          = empty($body_class)          ? ''            : $body_class;
$breadcrumbs         = empty($breadcrumbs)         ? array()       : array_merge(array('/' => 'Home'), $breadcrumbs);
$menu                = empty($menu)                ? false         : $menu;
$top_menu            = empty($top_menu)            ? array()       : $top_menu;

$top_menu  = MozillaOrg_TopMenu::factory($top_menu, $breadcrumbs);
$left_menu = MozillaOrg_LeftMenu::factory($menu, $breadcrumbs);

if ($left_menu instanceof MozillaOrg_LeftMenu) {
    $main_class = ' class="with-menu"';
} else {
    $main_class = '';
}

$current_year = date('Y');

?>
<!DOCTYPE html>
<html lang="en-US" dir="<?= $textdir ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

    <meta name="viewport" content="width=978" />

    <title><?=$html_title?></title>

    <link rel="shortcut icon" type="image/ico" href="/org/favicon.ico" />

    <link href="<?=$config['style_prefix']?>/style/screen-2010.css?date=2010-12-05" rel="stylesheet" media="screen, projection">

    <!--[if lt IE 7]><script type="text/javascript" src="<?=$config['js_prefix']?>/script/1.0/unitpngfix.js"></script><![endif]-->

    <?=$extra_style?>
    
    <style>
        /* MetaWebPro font family licensed from fontshop.com. WOFF-FTW! */
    @font-face {
        font-family: 'MetaBold';
        src: url('//www.mozilla.org/img/fonts/MetaWebPro-Bold.eot');
        src: local('☺'), url('//www.mozilla.org/img/fonts/MetaWebPro-Bold.woff') format('woff');
        font-weight: bold;
    }
    </style>

    <script src="<?=$config['js_prefix']?>/script/1.0/jquery-1.4.3.min.js"></script>
    <script src="<?=$config['js_prefix']?>/script/1.0/jquery-ui-1.7.2.custom.min.js"></script>
    <script src="<?=$config['js_prefix']?>/script/1.0/mozilla.org.js"></script>
    <?=$extra_js?>

    <?=$extra_headers?>

</head>

<body<?
    if (strlen($body_id)) echo ' id="'.$body_id.'"';
    if (strlen($body_class)) echo ' class="'.$body_class.'"';
?>>

<ul id="skip">
<?php if ($left_menu instanceof MozillaOrg_LeftMenu): ?>
    <li><a href="#localnav">Skip to Sub Navigation</a></li>
<?php endif; ?>
    <li><a href="#main">Skip to Content</a></li>
</ul>

<div id="header">
    <h1 class="unitPng">
      <a href="/" title="Back to home page">mozilla</a>
    </h1>

    <div id="header-contents">
      <?php $top_menu->display(); ?>
      <form id="quick-search" action="http://www.google.com/cse" title="Search Mozilla sites">
        <input type="hidden" name="cx" value="002443141534113389537:ysdmevkkknw">
        <input type="hidden" name="cof" value="FORID:0">
        <input type="search" name="q" id="q" placeholder="Search"><input type="image" src="<?=$config['img_prefix']?>/images/template/search-submit.png" alt="Search" id="quick-search-btn">
      </form>
    </div>

</div><!-- end #header -->

<?php
if (count($breadcrumbs) > 0) {
    ?><p id="crumbs"><span id="crumbs-contents"><?php
    MozillaOrg_Breadcrumb::display($breadcrumbs);
    ?></span></p><?php
}
?>

<div id="main"<?=$main_class?>>
