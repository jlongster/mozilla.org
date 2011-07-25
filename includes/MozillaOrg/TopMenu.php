<?php

/**
 * Displays the top-level menu on the Mozilla.org website
 *
 * @category  HTML
 * @package   MozillaOrg
 * @copyright 2009 silverorange Inc.
 * @copyright 2009 Mozilla Corporation
 */
class MozillaOrg_TopMenu
{
    /**
     * Menu data
     *
     * @var array
     */
    protected static $data = array(
        array(
            'title' => 'About Us',
            'link'  => '/about/',
        ),
        array(
            'title' => 'Community Map',
            'link'  => '/community/',
        ),
        array(
            'title' => 'Our Projects',
            'link'  => '/projects/',
        ),
        array(
            'title' => 'Get Involved',
            'link'  => '/contribute/',
        ),
    );

    /**
     * The link of the selected node of this menu
     *
     * @var string
     */
    protected $selected = '';

    /**
     * Convenience method for creating top menus
     *
     * Example usage:
     * <?php
     * <code>
     * $menu = array(
     *     'selected' => '/about/'
     * );
     * $menu = MozillaOrg_TopMenu::factory($menu);
     * $menu->display();
     * </code>
     *
     * @param array $args        optional. Menu arguments. The array may
     *                           contain a 'selected' element with the link of
     *                           the selected menu node.
     * @param array $breadcrumbs optional. The breadcrumbs array of the current
     *                           page. This is used to magically set the tri-
     *                           state state of menu nodes.
     *
     * @return MozillaOrg_TopMenu a top-menu object.
     */
    public static function factory($args = array(), $breadcrumbs = array())
    {
        if (!is_array($args)) {
            $args = array();
        }

        if (!is_array($breadcrumbs)) {
            $breadcrumbs = array();
        }

        if (!array_key_exists('selected', $args)) {
            $args['selected'] = '';
        }

        if (!is_string($args['selected'])) {
            $args['selected'] = strval($args['selected']);
        }

        return new self($args['selected'], $breadcrumbs);
    }

    /**
     * Ceates a new top menu
     *
     * @param string $selected    optional. The link of the selected menu
     *                            node.
     * @param array  $breadcrumbs optional. A breadcrumbs array used to set
     *                            the tri-state state of menu nodes for this
     *                            menu.
     */
    public function __construct($selected = '', array $breadcrumbs = array())
    {
        $this->selected    = $selected;
        $this->breadcrumbs = $breadcrumbs;
    }

    /**
     * Displays this menu
     *
     * @return void
     */
    public function display()
    {
        echo "<ul id=\"nav\">\n";
        $first = true;
        foreach (self::$data as $node) {
            $this->displayNode($node, $first);
            if ($first) {
                $first = false;
            }
        }
        echo "</ul><!-- end #nav -->\n";
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
     */
    protected function displayNode(array $node, $first = true)
    {
        if ($this->isInBreadcrumbs($node)) {
            if ($this->selected == $node['link']) {
                $class = 'selected on';
            } else {
                $class = 'selected';
            }
        } else {
            if ($this->selected == $node['link']) {
                $class = 'on';
            } else {
                $class = '';
            }
        }

        if ($first) {
            $class .= ' first';
        }

        if ($class != '') {
            echo '    <li class="' . $class . '">';
        } else {
            echo '    <li>';
        }

        if (   array_key_exists('desc', $node)
            && $node['desc'] != $node['title']) {
            $title = " title=\"{$node['desc']}\"";
        } else {
            $title = "";
        }

        if (   !array_key_exists('link', $node)
            || $this->selected == $node['link']
        ) {
            echo "<span{$title}>{$node['title']}</span>";
        } else {
            echo "<a{$title} href=\"{$node['link']}\">",
                $node['title'],
                "</a>";
        }

        echo "</li>\n";
    }

    /**
     * Gets whether or not a node is in the array of breadcrumbs for this menu
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
