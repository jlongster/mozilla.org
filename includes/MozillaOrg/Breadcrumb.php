<?php

/**
 * Displays page breadcrumbs
 *
 * @category  HTML
 * @package   MozillaOrg
 * @copyright 2009 silverorange Inc.
 * @copyright 2005-present Mozilla Corporation
 */
class MozillaOrg_Breadcrumb
{
    /**
     * Displays a breadcrumb string
     *
     * If the href for a breadcrumb entry is empty, it's assumed that it is
     * the last in the line of breadcrumbs and is surrounded by a <span>
     * instead of an <a> and is not followed by a raquo.
     *
     * @param array $breadcrumbs an array of breadcrumbs in the following
     *                           format:
     *                           <code>
     *                           array(
     *                               'href' => 'title',
     *                               'href' => 'title',
     *                                ...
     *                           );
     *                           </code>
     *
     * @return void
     */
    public static function display($breadcrumbs)
    {
        if (!is_array($breadcrumbs)) {
            echo '';
        }

        $_breadcrumb_link_string = '';

        foreach ($breadcrumbs as $href => $title) {
            if (!empty($title)) {
                if (empty($href)) {
                    echo "<span>{$title}</span>\n";
                } else {
                    echo "<a href=\"{$href}\">{$title}</a> / \n";
                }
            }
        }

        echo $_breadcrumb_link_string;
    }
}

?>
