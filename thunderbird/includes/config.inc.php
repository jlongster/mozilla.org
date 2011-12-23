<?php
ini_set('display_errors', true);
ini_set('error_reporting', E_ALL);

/**
 * MozillaMessaging.com configuation file.  This needs to be setup before the site will work.
 * There are other requirements as well.  Read the README.
 *
 * All language config (what languages are available) are in:
 *      /includes/langconfig.inc.php
 */
/**
 * Holds the server name (domain name).  Locales will be prepended to this.  We can't
 * use $_SERVER['SERVER_NAME'] because they might already have prepended the locale.
 *
 * Example:
 *  khan.mozilla.org
 *      or
 *  mozilla.org
 */
$config['server_name'] = 'www.mozilla.org';

/**
 * file path to the root directory.  We're defining it here instead of using relative
 * paths and code like "dirname(__FILE__)" just for the speed.  If we don't need to
 * do a bunch of repetitive code, there's no need to. No trailing slash.
 *
 * Example:
 *  /data/khan.mozilla.org
 *      or
 *  /var/www
 */
$config['file_root'] = dirname(dirname(__FILE__));

/**
 * The default language to use when all our language parsing/guessing fails.
 * Example:
 *  en-US
 *      or
 *  de
 */
$config['default_lang'] = 'en-US';


/**
 * Holds the url scheme (what is before the colon).  This is now set automatically -
 * no need to change this variable.
 *
 * Example:
 *  http
 *      or
 *  https
 */
if (array_key_exists('HTTPS', $_SERVER) && $_SERVER['HTTPS'] == 'on') {
    $config['url_scheme'] = 'https';
} else {
    $config['url_scheme'] = 'http';
}


/**
 * Short answer: Don't mess with this.
 *
 * This is the name of the index file (DirectoryIndex in the apache config).  This variable is 
 * needed for detecting 404s, as illustrated in the following scenario:
 * 
 * A user goes to http://xx-YY.www.mozilla.com/, where xx-YY is going to give a 404.
 * That's actually picked up by apache and rerouted to /includes/prefetch.php.
 *
 * The prefetch script is going to look if the page exists in the
 * $config['default_lang'] directory before it gives a 404.  However, when a user
 * doesn't specify the file, it comes through as '/' - that's not gonna work for php,
 * so this is the name of the file.  Right now we're using index.html because that is
 * what the old site used.  If we ever completely rewrite and use .php extensions,
 * change this (that is, unlikely...).
 */
$config['directory_index'] = 'index.html';

$config['static_prefix'] = '/thunderbird';

/**
 * What is the Google Maps API key for this server?  Used on, for example, en-US/about/contact.html
 *
 * Example:
 *  ABQIAAAAJxF9iCN32uVbCYVf9GYBZRR47t7R1oHohFx0gayQC_gitAXJnxSphNGrLLbOUsWrFdLjZtYlFsa2cg
 */
$config['gmap_api_key'] = 'ABQIAAAAJxF9iCN32uVbCYVf9GYBZRR4RvuhIVMVAVGkTLProETI91L3NxS9Bzn4k4gCwBbc2ls3ZXu0Qdt5yg';

/**
 * Funnelcake suffix.  If a Funnelcake run is happening set this variable to the
 * appropriate suffix, otherwise leave blank.  This only affects:
 *      /$lang/index.html
 *      /$lang/thunderbird/index.html
 *      /$lang/thunderbird/all.html
 *
 * Example:
 * $config['tb_funnelcake']['suffix'] = '-01';
 */
//$config['tb_funnelcake']['suffix'] = '-04';

/**
 * Funnelcake language list. This is an array that contains a list of languages
 * for which the funnelcake suffix will be used.
 *
 * Example:
 * $config['tb_funnelcake']['lang'] = array('de', 'en-US');
*/
//$config['tb_funnelcake']['lang'] = array('de', 'en-US');

/**
 * Earlybird download urls.
*/
$config['earlybird']['win'] = 'http://ftp.mozilla.org/pub/mozilla.org/thunderbird/nightly/latest-earlybird/thunderbird-11.0a2.en-US.win32.installer.exe';
$config['earlybird']['linux'] = 'http://ftp.mozilla.org/pub/mozilla.org/thunderbird/nightly/latest-earlybird/thunderbird-11.0a2.en-US.linux-i686.tar.bz2';
$config['earlybird']['osx'] = 'http://ftp.mozilla.org/pub/mozilla.org/thunderbird/nightly/latest-earlybird/thunderbird-11.0a2.en-US.mac.dmg';


?>
