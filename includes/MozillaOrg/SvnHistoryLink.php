<?php

/**
 * Displays SVN history link in the footer
 *
 * @category  HTML
 * @package   MozillaOrg
 * @copyright 2009 silverorange Inc.
 * @copyright 2009 Mozilla Corporation
 */
class MozillaOrg_SvnHistoryLink
{
    /**
     * Prefetch script base path for PHP_SELF
     */
    const BASE = '/includes/prefetch.php/';

    /**
     * Base URI for ViewVC revision history links
     */
    const VIEWVC = 'http://viewvc.svn.mozilla.org/vc/projects/mozilla.org/trunk/';

    /**
     * Get a formatted date that indicates when the given file was last
     * modified.
     *
     * @param string $file The file to get last modified date for.
     *
     * @param string $fmt A valid PHP date() format string (optional; defaults to 'F j, Y').
     *
     * @return string
     */
    public static function getLastModifiedDate($file, $fmt = 'F j, Y')
    {
        if (is_readable($file)) {
            return date($fmt, filemtime($file));
        }

        // File is not readable, so assume it was last modified now.
        return date($fmt);
    }

    /**
     * Displays an SVN history link for the current page with the last modified
     * date as the text.
     *
     * @return void
     */
    public static function display()
    {
        global $config;

        $filename = self::getSvnFilename($_SERVER['PHP_SELF']);
        $uri      = self::VIEWVC . $filename . '?view=log';
        $path     = $config['file_root'] . '/' . $filename;
        $date     = self::getLastModifiedDate($path);
        $title    = 'Last modified on ' . $date;
        echo '<a href="' . htmlentities($uri, ENT_QUOTES, 'UTF-8') . '">' . $title . '</a>';
    }

    /**
     * Gets the SVN filename of the current page
     *
     * The SVN filename is derived from PHP_SELF after removing the prefetch
     * script information.
     *
     * @param string $php_self
     *
     * @return string
     */
    protected static function getSvnFilename($php_self)
    {
        $filename = end(explode(self::BASE, $php_self));
        return $filename;
    }
}

?>
