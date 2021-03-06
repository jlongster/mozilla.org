<?php

/**
 * Mozilla.com prefetch script.  This will determine what server the request should
 * go to (for l10n stuff), and if we're already there, then display the file the user
 * is looking for.
 */
header('HTTP/1.1 200 OK');

// Load our config
require dirname(__FILE__).'/config.inc.php';

// Load our language config
require dirname(__FILE__).'/langconfig.inc.php';

// Load the product details classes
require dirname(__FILE__).'/thunderbirdDetails.class.php';

// Load our migrated over functions
require dirname(__FILE__).'/functions.inc.php';

// Load the l10n class from moz-europe
require dirname(__FILE__).'/l10n_moz.class.php';

// Start off pessimistic :)
$lang = null;

// If a ?p=... query parameter is supplied, set a partner cookie.
if (isset($_GET['p'])) { 
    $partners = array(
        'foxmarks', 'ebay', 'foxytunes', 'stumbleupon', 'cooliris', 
        'linkedin', 'forecastfox', 'downloadday'
    );
    if (in_array($_GET['p'], $partners)) {
        setcookie('partner', $_GET['p'], time() + ( 60*60*24*7 ), '/', '.mozilla.com');
    }
}

// (Last minute addition) The way we're choosing languages at the bottom of the
// footer now passes the language in via get - this overrides all other ways of
// choosing a language, so we're looking for it first:
if (array_key_exists('flang', $_GET) && !empty($_GET['flang'])) {
    // If it's in our language array, we've got content, we're good to go.
    if (!array_key_exists($_GET['flang'], $language_url_map)) {
        $lang = null;
    } else {
        $lang = $_GET['flang'];
    }
}

if ($lang == null) {
    // We're hoping they went to a specific host like en-us.mozilla.org.  list() will
    // give us the first chunk.
    list($lang) = explode('.',$_SERVER['SERVER_NAME']);

    // If it's in our language array, we've got content, we're good to go.
    if (!in_array($lang, array_map('strtolower', $full_languages))) {
        $lang = null;
    }
}

// Our first try didn't work, so check for the old way of specifying a language: http://mozilla.com/de/
if ($lang == null) {
    $temp = explode('/', $_SERVER['REQUEST_URI']);
    if (in_array(strtolower($temp[1]), array_map('strtolower', $full_languages))) {
        $lang = $temp[1];
    }
}

// Some of our redirects tack this stuff onto the path, which shows up in PATH_INFO
// (its-a-trap, I'm looking at you...)
if ($lang == null && array_key_exists('PATH_INFO',$_SERVER)) {
    $temp = explode('/', $_SERVER['PATH_INFO']);
    if (in_array(strtolower($temp[1]), array_map('strtolower',$full_languages))) {
        $lang = $temp[1];
    }
}

// If they didn't go to a host (they just went to mozilla.org) we'll parse their
// accept language header and try to guess where they want to go.

if (    $lang == null 
     && array_key_exists('HTTP_ACCEPT_LANGUAGE', $_SERVER) 
     && !empty($_SERVER['HTTP_ACCEPT_LANGUAGE']) 
   ) {
    $acclang = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);

    foreach ($acclang as $val) {
        // The value of the accept language could have a semi-colon in it (for
        // priority).  If it does, we explode, grab the first value, trim the
        // whitespace, and we've got the locale.
        $language = trim(array_shift(explode(';', $val)));

        // Check if the language is one we support
        if (in_array(strtolower($language), array_map('strtolower', $full_languages))) {

            $lang = $language;
            break; // found one

        } else {

            // If there is a dash, this will grab the short language name
            $language = array_shift(explode('-', $language));

            if (in_array(strtolower($language), array_map('strtolower',$full_languages))) {
                $lang = $language;
                break; // found one
            } else {
                $lang = null; // (it's already null, but hey..)
            }
        }
    }
}

// If we're remapping the language to another
if (array_key_exists(strtolower($lang), $lang_remap)) {
    // Rewrite the request vars to use the language we're claiming to have detected.  
    if (strtolower(substr($_SERVER['REDIRECT_URL'], 1, strlen($lang))) == strtolower($lang)) {
        $_SERVER['REDIRECT_URL'] = '/'.$lang_remap[strtolower($lang)].substr($_SERVER['REDIRECT_URL'], strlen($lang)+1);
        $_SERVER['REQUEST_URI'] = '/'.$lang_remap[strtolower($lang)].substr($_SERVER['REQUEST_URI'], strlen($lang)+1);
    }
    $lang = $lang_remap[strtolower($lang)];
}

// After our detection is all said and done, we want the locale in the form xx-YY for
// file includes, etc.
if (strstr($lang,'-')) {
    list($x,$y) = explode('-', $lang);
    $lang = "{$x}-".strtoupper($y);
    unset($x,$y);
} else {
    $lang = strtolower($lang);
}

// If all our detection and guessing failed, fall back to the default
if ($lang == null || !in_array($lang, $full_languages)) {
    $lang = $config['default_lang'];
}

// A lot of the migrated scripts depend on the language being in LANG
define ('LANG', $lang);

    if ($lang == 'ja') {
        $redir = str_replace('/ja', '', $_SERVER['REQUEST_URI']);
        $redir = "Location: http://mozilla.jp" . $redir;
        Header( $redir );
        header('Vary: Accept-Language');
        exit;
    }
    // If the URL doesn't have a langauage at the front of it, we need to redirect so
    // it does (otherwise we get stuff with no language at all.  For example:
    //  www.mozilla.com/firefox   -->    www.mozilla.com/en-US/firefox
    if (substr($_SERVER['REDIRECT_URL'], 1, strlen($lang)) != $lang) {
        header("Location: {$config['url_scheme']}://{$config['server_name']}/{$lang}{$_SERVER['REQUEST_URI']}");
        header('Vary: Accept-Language');
        exit;
    }
    
    // All the firefox2 in-product pages have the language in the REDIRECT_URL.
    // We're using $lang already to put it in the right directories, so we don't want
    // this on there as well.  If $lang is at the front of the URL, this removes it.
    if (substr($_SERVER['REDIRECT_URL'], 1, strlen($lang)) == $lang) {
        $_SERVER['REDIRECT_URL'] = substr($_SERVER['REDIRECT_URL'], strlen($lang)+1);
    }

    // Special check for an index page.  This is explained in
    // /includes/config.inc.php in the "directory_index" section.  Basically, if
    // we're looking at a directory, check for the index page underneath
    if (is_dir("{$config['file_root']}/{$lang}{$_SERVER['REDIRECT_URL']}")) {
        $_SERVER['REDIRECT_URL'] = "{$_SERVER['REDIRECT_URL']}/{$config['directory_index']}";
    }

    // Check and make sure our file exists
    if (file_exists("{$config['file_root']}/{$lang}{$_SERVER['REDIRECT_URL']}")) {
        // Headers and footers are included on a per-page basis.
        // This is because we need to change some variables for each page
        // for compatiblity with the CSS we have.  The per-page headers are in
        // /$lang/includes/header.inc.php

        // Setup the moz-europe code.  $l10n is used in the included files
        $l10n = new l10n_moz();

        // Parse the language file and drop info in a global variable
        $l10n->load("{$config['file_root']}/{$lang}/includes/l10n/main.lang");

        $thunderbirdDetails = new thunderbirdDetails();

        // Include our main page.
        require_once "{$config['file_root']}/{$lang}{$_SERVER['REDIRECT_URL']}";

        // We're all done.
        exit;

    } else {
        // Under normal circumstances, we'd have a 404 - However, we're kind of
        // building a Frankensite with the old mozilla.com.  While we're in this
        // transitional phase, we need to check if the page they are looking for
        // exists in the default locale (en-us), and if so, we'll forward them there.
        if (file_exists("{$config['file_root']}/{$config['default_lang']}{$_SERVER['REDIRECT_URL']}")) {

            if (substr($_SERVER['REQUEST_URI'], 1, strlen($lang)) == $lang) {
                $_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'], strlen($lang)+1);
            }
            header("Location: {$config['url_scheme']}://{$config['server_name']}/{$config['default_lang']}{$_SERVER['REQUEST_URI']}");
            header('Vary: Accept-Language');
            exit;
        }

        // We've got a 404, show a localized 404 page
        header("HTTP/1.1 404 Not Found");
        header('Status: 404 Not Found');
        header('Vary: Accept-Language');

        // Setup the moz-europe code.  $l10n is used in the included files.
        $l10n = new l10n_moz();

        // None of our locales actually have a localized 404 right now, but if
        // they do some day, it'll be easy just to drop them in there.
        if (   file_exists("{$config['file_root']}/{$lang}/404.html")
            && file_exists("{$config['file_root']}/{$lang}/includes/l10n/main.lang")) {

            // Parse the language file and drop info in a global variable
            $l10n->load("{$config['file_root']}/{$lang}/includes/l10n/main.lang");

            // Show the localized 404
            require_once "{$config['file_root']}/{$lang}/404.html";
        } else {
            // Parse the language file and drop info in a global variable
            $l10n->load("{$config['file_root']}/{$config['default_lang']}/includes/l10n/main.lang");

            // Show the default 404
            require_once "{$config['file_root']}/{$config['default_lang']}/404.html";
        }
        exit;
    }
?>
