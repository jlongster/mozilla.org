<?php
//hijack to thunderbird prefetch if thunderbird is within the first two components of the uri
$urlstring = explode('/',$_SERVER['REQUEST_URI']);

for ($i = 0; $i <= min(2, count($urlstring)-1); $i++) {
    if ($urlstring[$i] == 'thunderbird') {
        require_once '../thunderbird/includes/prefetch.php';
        exit;
    }
}

// Load our config
require dirname(__FILE__).'/config.inc.php';

// This checks if we're already at our destination (to avoid an endless redirection
// loop).  If we are, grab the file we need, echo it out, and we're done.
if ($_SERVER['SERVER_NAME'] == $config['server_name']) {

    // Special check for an index page.  This is explained in
    // /includes/config.inc.php in the "directory_index" section.  Basically, if
    // we're looking at a directory, check for the index page underneath
    if (is_dir("{$config['file_root']}/{$_SERVER['REDIRECT_URL']}")) {
        $_SERVER['REDIRECT_URL'] = "{$_SERVER['REDIRECT_URL']}/{$config['directory_index']}";
    }

    // Check and make sure our file exists
    if (file_exists("{$config['file_root']}/{$_SERVER['REDIRECT_URL']}")) {
        // Headers and footers are included on a per-page basis.
        // This is because we need to change some variables for each page
        // for compatiblity with the CSS we have.  The per-page headers are in
        // /$lang/includes/header.inc.php

        // Include our main page.
        require_once "{$config['file_root']}/{$_SERVER['REDIRECT_URL']}";

        // We're all done.
        exit;

    }

    $www_archive_base = '/data/www/www-archive.mozilla.org';
    $path = $_SERVER['REQUEST_URI'];
    $www_archive_path = realpath($www_archive_base . $path);

    // Redirect if it's in the archive
    if (strpos($www_archive_path, $www_archive_base) == 0 && file_exists($www_archive_path)) {
      header("Status: 301 Moved Permanently");
      header("Location: http://www-archive.mozilla.org$path");
      exit;
    }

    // We've got a 404, show a 404 page
    $url = 'http';
    if (array_key_exists('HTTPS', $_SERVER) && $_SERVER["HTTPS"] == "on") {$url .= "s";}
    $url .= "://" . $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    $uri = $_SERVER['REQUEST_URI'];
    $referer = array_key_exists('HTTP_REFERER', $_SERVER) ? $_SERVER['HTTP_REFERER'] : NULL;

    header('Status: 404 Not Found');
    header('Pragma: no-cache');
    header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0, private');

    // Show the 404
    require_once "{$config['file_root']}/404.html";

    exit;
}

// Forward them on to the right URI - this needs to be REQUEST_URI so it passes
// parameters
header("Location: {$config['url_scheme']}://{$config['server_name']}/{$_SERVER['REQUEST_URI']}");
header('Pragma: no-cache');
header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0, private');
exit;

?>
