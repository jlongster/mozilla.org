<?php

require_once dirname(__FILE__) . '/FavIconHandler.php';

/**
 * Custom favicon handler for resolving favicons of the various
 * categories provided by Lizard Feeder
 *
 * See {@link https://svn.mozilla.org/projects/lizardfeeder/trunk/conf/config.ini-dist}.
 *
 * @category  HTML
 * @package   MozillaOrg
 * @author    Michael Gauthier <mike@silverorange.com>
 * @copyright 2009 silverorange Inc.
 * @copyright 2009 Mozilla Corporation
 * @license   http://www.mozilla.org/MPL/ Mozilla Public License
 */
class MozillaOrg_FeedParser_CommunityFavIconHandler
    extends MozillaOrg_FeedParser_FavIconHandler
{
    /**
     * Maps a Lizard Feeder source short-name to a favicon URI
     *
     * @var array
     */
    public static $map = array(
        'amo-updated'               => '/images/home/icons/amo-updated.ico',
        'bugzilla'                  => '/images/home/icons/bugzilla.png',
        'cvs'                       => '/images/home/icons/cvs.ico',
        'delicious-mozilla'         => '/images/home/icons/delicious-mozilla.ico',
        'delicious-mozilla-popular' => '/images/home/icons/delicious-mozilla-popular.ico',
        'devmo'                     => '/images/home/icons/devmo.ico',
        'labs-forum'                => '/images/home/icons/labs-forum.png',
        'mercurial'                 => '/images/home/icons/mercurial.png',
        'mozillaflickrsearch'       => '/images/home/icons/mozillaflickrsearch.ico',
        'planet'                    => '/images/home/icons/planet.png',
        'planet-mozilla-messaging'  => '/images/home/icons/planet-mozilla-messaging.png',
        'qmo'                       => '/images/home/icons/qmo.ico',
        'spreadfirefox'             => '/images/home/icons/spreadfirefox.ico',
        'spreadfirefoxevents'       => '/images/home/icons/spreadfirefoxevents.ico',
        'spreadthunderbird'         => '/images/home/icons/spreadthunderbird.png',
        'svn'                       => '/images/home/icons/svn.ico',
        'twitter-mozilla'           => '/images/home/icons/twitter-mozilla.ico',
        'upcoming-mozilla'          => '/images/home/icons/upcoming-mozilla.ico',
        'wikimo'                    => '/images/home/icons/wikimo.ico',
    );

    public function getFavIcon(SimplePie_Item $item)
    {
        $shortname = '';

        $categories = $item->get_categories();
        foreach ($categories as $category) {
            $matches = array();
            $matched = preg_match(
                '/short=([a-z-]+)/',
                $category->get_term(),
                $matches
            );

            if ($matched === 1) {
                $shortname = $matches[1];
                break;
            }
        }

        if (array_key_exists($shortname, self::$map)) {
            $favIcon = self::$map[$shortname];
        } else {
            $favIcon = $item->get_feed()->get_favicon();
        }

        return $favIcon;
    }
}

?>
