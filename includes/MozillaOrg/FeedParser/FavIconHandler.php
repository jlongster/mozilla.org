<?php

/**
 * Abstract class for custom handling of favicons for the feed parser
 *
 * @category  HTML
 * @package   MozillaOrg
 * @author    Michael Gauthier <mike@silverorange.com>
 * @copyright 2009 silverorange Inc.
 * @copyright 2009 Mozilla Corporation
 * @license   http://www.mozilla.org/MPL/ Mozilla Public License
 */
abstract class MozillaOrg_FeedParser_FavIconHandler
{
    abstract public function getFavIcon(SimplePie_Item $item);
}

?>
