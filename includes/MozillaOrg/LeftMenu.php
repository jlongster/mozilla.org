<?php

/**
 * Displays the various sub-menus on the Mozilla.org website
 *
 * @category  HTML
 * @package   MozillaOrg
 * @copyright 2009 silverorange Inc.
 * @copyright 2009 Mozilla Corporation
 */
class MozillaOrg_LeftMenu
{
    /**
     * Menu data for all menus
     *
     * @var array
     */
     
    protected static $data = array(
        // {{{ about
        'about' => array(
          array(
            'title' => 'About Us',
            'link'  => '/about/',
            'items' => array(
                array(
                    'title' => 'Our Mission',
                    'link'  => '/about/mission.html',
                ),
                array(
                    'title' => 'Forums',
                    'link'  => '/about/forums/',
                ),
                array(
                    'title' => 'Governance',
                    'link'  => '/about/governance.html',
                ),
                array(
                    'title' => 'History',
                    'link'  => '/about/history.html',
                ),
              ),
            ),
        ),
        // }}}
        // {{{ community
        'community' => array(
          array(
            'title' => 'Community Map',
            'link'  => '/community/',
            'items' => array(
                array(
                    'title' => 'Applications',
                    'link'  => '/community/#applications',
                ),
                array(
                    'title' => 'Code',
                    'link'  => '/community/#code',
                ),
                array(
                    'title' => 'Incubators',
                    'link'  => '/community/#incubators',
                ),
                array(
                    'title' => 'Community Sites',
                    'link'  => '/community/#community-sites',
                ),
                array(
                    'title' => 'Directory',
                    'link'  => '/community/directory.html',
                ),
              ),
            ),
        ),
        // }}}
        // {{{ foundation
        'foundation' => array(
          array(
            'title' => 'The Mozilla Foundation',
            'link'  => '/foundation/',
            'items' => array(
                array(
                    'title' => 'About the Foundation',
                    'link'  => '/foundation/about.html',
                ),
                array(
                    'title' => 'Annual Report',
                    'link'  => '/foundation/annualreport/2009/',
                ),
                array(
                    'title' => 'Careers',
                    'link'  => '/foundation/careers.html',
                ),
                array(
                    'title' => 'Donate',
                    'link'  => 'https://donate.mozilla.org/page/contribute/openwebfund',
                    'desc'  => 'Donate To The Mozilla Foundation',
                ),
                array(
                    'title' => 'Licensing &amp; Trademarks',
                    'link'  => '/foundation/licensing.html',
                ),
                array(
                    'title' => 'Public Documents',
                    'link'  => '/foundation/documents/',
                ),
              ),
          ),
        ),
        // }}}
        // {{{ contribute
        'contribute' => array(
          array(
            'title' => 'Get Involved',
            'link'  => '/contribute/',
            'items' => array(
                array(
                    'title' => 'Area of Interest',
                    'link'  => '/contribute/areas.html',
                ),
                array(
                    'title' => 'Time Available',
                    'link'  => '/contribute/timeavailable.html',
                ),
                array(
                    'title' => 'Mozilla Near You',
                    'link'  => '/contribute/local/',
                ),
                array(
                    'title' => 'Download Buttons',
                    'link'  => '/contribute/buttons/',
                ),
              ),
          ),
        ),
        // }}}
        // {{{ projects
        'projects' => array(
          array(
            'title' => 'Our Projects',
            'link'  => '/projects/',
            'items' => array(
                array(
                    'title' => 'Mozilla Applications',
                    'link'  => '/projects/#applications',
                ),
                array(
                    'title' => 'Mozilla Drumbeat Projects',
                    'link'  => '/projects/#drumbeat',
                ),
                array(
                    'title' => 'Mozilla Labs Experiments',
                    'link'  => '/projects/#labs',
                ),
                array(
                    'title' => 'Mozilla Developer Tools',
                    'link'  => '/projects/#tools',
                ),
                array(
                    'title' => 'Mozilla-based Applications',
                    'link'  => '/projects/#poweredby',
                ),
                array(
                    'title' => 'Mozilla Technologies',
                    'link'  => '/projects/#technologies',
                ),
                array(
                    'title' => 'Archived Projects',
                    'link'  => '/projects/#archive',
                ),
              ),
            ),
        ),
        // {{{ default
        'default' => array(
            array(
                'title' => 'Roadmap',
                'link'  => '/roadmap.html',
            ),
            array(
                'title' => 'Projects',
                'link'  => '/projects/',
            ),
            array(
                'title' => 'Coding',
                'link'  => '/developer/',
                'desc'  => 'For developers',
                'items' => array(
                    array(
                        'title' => 'Module Owners',
                        'link'  => '/about/owners.html',
                    ),
                    array(
                        'title' => 'Hacking',
                        'link'  => '/hacking/',
                    ),
                    array(
                        'title' => 'Get the Source',
                        'link'  => 'https://developer.mozilla.org/en/Download_Mozilla_Source_Code',
                    ),
                    array(
                        'title' => 'Build It',
                        'link'  => 'https://developer.mozilla.org/en/Build_Documentation',
                    ),
                ),
            ),
            array(
                'title' => 'Testing',
                'link'  => 'http://quality.mozilla.org/',
                'items' => array(
                    array(
                        'title' => 'Releases',
                        'link'  => '/download.html',
                        'desc'  => 'Downloads of mozilla.org software releases',
                    ),
                    array(
                        'title' => 'Nightly Builds',
                        'link'  => '/developer/#builds',
                        'desc'  => 'Latest mozilla builds for testers',
                    ),
                    array(
                        'title' => 'Report A Problem',
                        'link'  => 'https://bugzilla.mozilla.org/',
                        'desc'  => 'For testers to report bugs',
                    ),
                ),
            ),
            array(
                'title' => 'Tools',
                'link'  => '/tools.html',
                'desc'  => 'Tools for mozilla developers',
                'items' => array(
                    array(
                        'title' => 'Bugzilla',
                        'link'  => 'https://bugzilla.mozilla.org/',
                        'desc'  => 'Bug tracking system for mozilla testers.',
                    ),
                    array(
                        'title' => 'Tinderbox',
                        'link'  => 'http://tinderbox.mozilla.org/showbuilds.cgi?tree=Firefox',
                        'desc'  => 'Latest status of mozilla builds',
                    ),
                    array(
                        'title' => 'Hg',
                        'link'  => 'http://hg.mozilla.org/',
                        'desc'  => 'Latest checkins',
                    ),
                    array(
                        'title' => 'MXR',
                        'link'  => 'http://mxr.mozilla.org/',
                        'desc'  => 'Source cross reference',
                    ),
                ),
            ),
            array(
                'title' => 'FAQ',
                'link'  => '/faq.html',
                'desc'  => 'Frequently Asked Questions',
            ),
        ),
        // }}}
        // {{{ xforms
        'xforms' => array(
          array(
            'title' => 'Mozilla XForms Project',
            'link'  => '/projects/xforms/',
            'items' => array(
                array(
                    'title' => 'About Us',
                    'link'  => '/projects/xforms/aboutus.html',
                ),
                array(
                    'title' => 'Documentation',
                    'link'  => '/projects/xforms/documentation.html',
                ),
                array(
                    'title' => 'Current Status',
                    'link'  => '/projects/xforms/status.html',
                ),
                array(
                    'title' => 'Download',
                    'link'  => '/projects/xforms/download.html',
                ),
                array(
                    'title' => 'Build',
                    'link'  => '/projects/xforms/build.html',
                ),
                array(
                    'title' => 'Feedback',
                    'link'  => '/projects/xforms/feedback.html',
                ),
                array(
                    'title' => 'Sample Forms',
                    'link'  => '/projects/xforms/samples.html',
                ),
              ),
            ),
        ),
        // }}}
        // {{{ thunderbird
        'thunderbird' => array(
            array(
                'title' => 'Thunderbird Help',
                'link'  => '/support/thunderbird/',
                'items' => array(
                    array(
                        'title' => 'Mozilla Thunderbird FAQ',
                        'link'  => '/support/thunderbird/faq',
                    ),
                    array(
                        'title' => 'Tips &amp; Tricks',
                        'link'  => '/support/thunderbird/tips',
                    ),
                    array(
                        'title' => 'Keyboard Shortcuts',
                        'link'  => '/support/thunderbird/keyboard',
                    ),
                    array(
                        'title' => 'Mouse Shortcuts',
                        'link'  => '/support/thunderbird/mouse',
                    ),
                    array(
                        'title' => 'Menu Reference',
                        'link'  => '/support/thunderbird/menu',
                    ),
                    array(
                        'title' => 'Editing Config. Files',
                        'link'  => '/support/thunderbird/edit',
                    ),
                    array(
                        'title' => 'Reporting Bugs',
                        'link'  => '/support/thunderbird/bugs',
                    ),
                ),
            ),
            array(
                'title' => 'Thunderbird Product Page',
                'link'  => '/products/thunderbird/',
            ),
            array(
                'title' => 'Forums',
                'link'  => '/support/thunderbird/forums',
            ),
        ),
        // }}}
        // {{{ calendar
        'calendar' => array(
            array(
                'title' => 'Calendar Project',
                'link'  => '/projects/calendar/',
                'items' => array(
                    array(
                        'title' => 'Donate to the Project',
                        'link'  => '/projects/calendar/donate.html',
                    ),
                    array(
                        'title' => 'About the Team',
                        'link'  => '/projects/calendar/about.html',
                    ),
                    array(
                        'title' => 'Developers Blog',
                        'link'  => 'http://weblogs.mozillazine.org/calendar/',
                    ),
                    array(
                        'title' => 'Help Us',
                        'link'  => '/projects/calendar/help.html',
                    ),
                    array(
                        'title' => 'Bugs',
                        'link'  => '/projects/calendar/bugs.html',
                    ),
                    array(
                        'title' => 'Developer Guide',
                        'link'  => 'https://wiki.mozilla.org/Calendar:Dev_Guide',
                    ),
                ),
            ),
            array(
                'title' => 'Lightning',
                'link'  => '/projects/calendar/lightning/',
                'items' => array(
                    array(
                        'title' => 'Download Lightning',
                        'link'  => '/projects/calendar/lightning/download.html',
                    ),
                    array(
                        'title' => 'Lightning Screenshots',
                        'link'  => '/projects/calendar/lightning/screenshot.html',
                    ),
                    array(
                        'title' => 'Build Lightning',
                        'link'  => 'https://developer.mozilla.org/en/Comm-central_source_code_(Mercurial)',
                    ),
                ),
            ),
            array(
                'title' => 'Mozilla Sunbird®',
                'link'  => '/projects/calendar/sunbird/',
                'items' => array(
                    array(
                        'title' => 'Download Sunbird',
                        'link'  => '/projects/calendar/sunbird/download.html',
                    ),
                    array(
                        'title' => 'International Downloads',
                        'link'  => '/projects/calendar/sunbird/l10n_download.html',
                    ),
                    array(
                        'title' => 'Sunbird Screenshots',
                        'link'  => '/projects/calendar/sunbird/screenshot.html',
                    ),
                    array(
                        'title' => 'Build Sunbird',
                        'link'  => '/projects/calendar/sunbird/build.html',
                    ),
                ),
            ),
            array(
                'title' => 'FAQs',
                'link'  => '/projects/calendar/faq.html',

            ),
            array(
                'title' => 'Holiday Calendars',
                'link'  => '/projects/calendar/holidays.html',
            ),
            array(
                'title' => 'Useful Links',
                'link'  => '/projects/calendar/links.html',
            ),
        ),
        // }}}
    );

    /**
     * The id of this menu
     *
     * @var string
     */
    protected $id = '';

    /**
     * The link of the selected node of this menu
     *
     * @var string
     */
    protected $selected = '';

    /**
     * Breadcrumbs array used to contain the tri-state state of nodes in this
     * menu
     *
     * Array is of the form:
     * <code>
     * <?php
     * $breadcrumbs = array(
     *     'Title'       => '/absolute/',
     *     'Other Title' => '/absolute/link/',
     * );
     * ?>
     * </code>
     *
     * Only the links are significant; titles may be any string.
     *
     * @var array
     */
    protected $breadcrumbs = array();

    /**
     * Convenience method for creating left menus
     *
     * Example usage:
     * <?php
     * <code>
     * $menu = array(
     *     'id'       => 'about',
     *     'selected' => '/about/policies.html'
     * );
     * $menu = MozillaOrg_LeftMenu::factory($menu);
     * if ($menu) {
     *     $menu->display();
     * }
     * </code>
     *
     * @param array|string $args        menu arguments. If this is a string,
     *                                  it is the id of the left-menu to
     *                                  create. If this is an array, it must
     *                                  contain an 'id' element with the id of
     *                                  the left-menu to create. The array may
     *                                  optionally contain a 'selected' element
     *                                  with the link of the selected menu
     *                                  node.
     * @param array        $breadcrumbs optional. The breadcrumbs array of the
     *                                  current page. This is used to magically
     *                                  set the tri-state state of menu nodes.
     *
     * @return MozillaOrg_LeftMenu|boolean a left-menu object if the arguments
     *                                     are valid, otherwise false.
     */
    public static function factory($args, $breadcrumbs = array())
    {
        $menu = false;

        if (!is_array($args)) {
            $args = array('id' => strval($args));
        }

        if (!is_array($breadcrumbs)) {
            $breadcrumbs = array();
        }

        if (   array_key_exists('id', $args)
            && is_string($args['id'])
            && array_key_exists($args['id'], self::$data)
        ) {
            if (!array_key_exists('selected', $args)) {
                $args['selected'] = '';
            }

            if (!is_string($args['selected'])) {
                $args['selected'] = strval($args['selected']);
            }

            $menu = new self($args['id'], $args['selected'], $breadcrumbs);
        }

        return $menu;
    }

    /**
     * Ceates a new left menu
     *
     * @param string $id          the id of this menu. Should be one of the
     *                            top-level ids defined in the
     *                            {@link MozillaOrg_LeftMenu::$data} array.
     * @param string $selected    optional. The link of the selected menu
     *                            node.
     * @param array  $breadcrumbs optional. A breadcrumbs array used to set
     *                            the tri-state state of menu nodes for this
     *                            menu.
     */
    public function __construct($id, $selected = '',
        array $breadcrumbs = array()
    ) {
        $this->id          = $id;
        $this->selected    = $selected;
        $this->breadcrumbs = $breadcrumbs;
    }

    /**
     * Gets the menu data for this menu
     *
     * Data is returned as a tree of nodes.
     *
     * @return array the menu data or an empty array if this menu has no data.
     */
    public function getMenuData()
    {
        $data = array();

        if (array_key_exists($this->id, self::$data)) {
            $data = self::$data[$this->id];
        }

        return $data;
    }

    /**
     * Displays this menu
     *
     * @return void
     */
    public function display()
    {
        echo "<div id=\"localnav\">\n";
        $this->displayNodes($this->getMenuData());
        echo "</div><!-- end #localnav -->\n";
    }

    /**
     * Displays a single node in this menu
     *
     * If the node has a node list of sub-items, the items are displayed
     * recursively.
     *
     * @param array   $node  the node to display.
     * @param boolean $first optional. Whether or not this node is the first
     *                       node in a node list. If not specified, defaults
     *                       to true.
     * @param integer $level optional. The current level of this menu. If
     *                       not specified, defaults to 0. This is only used
     *                       for pretty indentation.
     */
    protected function displayNode(array $node, $first = true, $level = 0)
    {
        $indent = str_repeat('    ', ($level  + 1) * 2);

        if ($first) {
            echo $indent, "<li class=\"first\">";
        } else {
            echo $indent, "<li>";
        }

        // get tri-state css class name
        if ($this->isInBreadcrumbs($node)) {
            if ($this->selected == $node['link']) {
                $class = " class=\"selected on\"";
            } else {
                $class = " class=\"selected\"";
            }
        } else {
            if ($this->selected == $node['link']) {
                $class = " class=\"on\"";
            } else {
                $class = "";
            }
        }

        // if the node has a description that differs from the title, use it
        // as the element's title attribute
        if (   array_key_exists('desc', $node)
            && $node['desc'] != $node['title']) {
            $title = " title=\"{$node['desc']}\"";
        } else {
            $title = "";
        }

        // display anchor for non-selected nodes, span for selected nodes or
        // for nodes that have no link set
        if (   !array_key_exists('link', $node)
            || $this->selected == $node['link']
        ) {
            echo "<span{$title}{$class}>{$node['title']}</span>";
        } else {
            echo "<a{$title}{$class} href=\"{$node['link']}\">",
                $node['title'],
                "</a>";
        }

        // if the node has sub-items, recurse
        if (array_key_exists('items', $node) && is_array($node['items'])) {
            echo "\n";
            $this->displayNodes($node['items'], false, $level + 1);
            echo $indent, "</li>\n";
        } else {
            echo "</li>\n";
        }
    }

    /**
     * Displays a node list in this menu
     *
     * @param array   $nodes the node list to display.
     * @param boolean $first optional. Whether or not this node list is the
     *                       first node list in this menu. If not specified,
     *                       defaults to true.
     * @param integer $level optional. The current level of this menu. If
     *                       not specified, defaults to 0. This is only used
     *                       for pretty indentation.
     */
    protected function displayNodes(array $nodes, $first = true, $level = 0)
    {
        $indent = str_repeat('    ', ($level * 2) + 1);

        if ($first) {
            echo $indent, "<ul class=\"first\">\n";
        } else {
            echo $indent, "<ul>\n";
        }

        $first = true;
        foreach ($nodes as $node) {
            $this->displayNode($node, $first, $level);
            if ($first) {
                $first = false;
            }
        }

        echo $indent, "</ul>\n";
    }

    /**
     * Gets whether or not a node is in the array of breadcrumbs for this
     * left menu
     *
     * @param array $node the menu node to check.
     *
     * @return boolean true if the node is in the array of breadcrumbs,
     *                 otherwise false.
     */
    protected function isInBreadcrumbs(array $node)
    {
        $found = false;

        if (array_key_exists('link', $node)) {
            foreach ($this->breadcrumbs as $key => $value) {
                // normalize links for matching
                $key  = trim($key, '/');
                $link = trim($node['link'], '/');

                if ($key === $link) {
                    $found = true;
                    break;
                }
            }
        }

        return $found;
    }

}

?>
