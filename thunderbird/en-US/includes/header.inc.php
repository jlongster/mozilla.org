<?php

        $dynamic_top_menu_array = array();

        if (is_array($GLOBALS['__l10n_moz'])) {
            $dynamic_top_menu_array = array (
                'id'    => 'nav-main',
                'items' => array(
                    'Thunderbird' => array(
                        'id'      => 'menu_thunderbird',
                        'href'    => "/{$lang}/thunderbird/",
                        'submenu' => array(
                            'items' => array(
                                'Features' => array(
                                    'id'      => 'submenu_thunderbird_features',
			                        'href'    => "/{$lang}/thunderbird/features/",
                                ),
                                'Release Notes' => array(
                                    'id'      => 'submenu_thunderbird_releasenotes',
			                        'href'    => "/{$lang}/thunderbird/".LATEST_THUNDERBIRD_VERSION."/releasenotes/",
                                ),
                                'Other Systems and Languages' => array(
                                    'id'      => 'submenu_thunderbird_other',
			                        'href'    => "/{$lang}/thunderbird/all.html",
                                )
                            )
                        )
                    ),
                    "{$GLOBALS['__l10n_moz']['Add-ons']}" => array(
                        'id'      => 'menu_addons',
                        'href'    => 'https://addons.mozilla.org/thunderbird/',
                        'submenu' => array(
                            'items' => array(
                                'All Add-ons' => array(
                                    'id'      => 'submenu_addons_all',
			                        'href'    => "https://addons.mozilla.org/thunderbird/",
                                ),
                                'Recommended' => array(
                                    'id'      => 'submenu_addons_recommended',
			                        'href'    => "https://addons.mozilla.org/thunderbird/recommended",
                                ),
                                'Popular' => array(
                                    'id'      => 'submenu_addons_popular',
			                        'href'    => "https://addons.mozilla.org/thunderbird/browse/type:1/cat:all?sort=popular",
                                ),
                                'Themes' => array(
                                    'id'      => 'submenu_addons_themes',
			                        'href'    => "https://addons.mozilla.org/thunderbird/browse/type:2",
                                )
                            )
                        )
                    ),
                    "{$GLOBALS['__l10n_moz']['Support']}"    => array(
                        'id'      => 'menu_support',
                        'href'    => "http://support.mozillamessaging.com/",
                    ),
                    "{$GLOBALS['__l10n_moz']['Community']}" => array(
                        'id'      => 'menu_community',
                        'href'    => "/community/",
                        'submenu' => array(
                            'items' => array(
                                'Add-ons' => array(
                                    'id'      => 'submenu_community_addons',
			                        'href'    => "http://addons.mozilla.org/thunderbird/",
                                ),
                                'Bugzilla' => array(
                                    'id'      => 'submenu_community_bugzilla',
			                        'href'    => "https://bugzilla.mozilla.org/",
                                ),
                                'Mozilla Developer Network' => array(
                                    'id'      => 'submenu_community_devmo',
			                        'href'    => "https://developer.mozilla.org/",
                                ),
                                'Mozilla Labs' => array(
                                    'id'      => 'submenu_community_labs',
			                        'href'    => "http://labs.mozilla.com/",
                                ),
                                'Mozilla.org' => array(
                                    'id'      => 'submenu_community_mozillaorg',
			                        'href'    => "http://www.mozilla.org/",
                                ),
                                'Mozilla.org' => array(
                                    'id'      => 'submenu_community_mozillaorg',
			                        'href'    => "http://www.mozilla.org/",
                                ),
                                'MozillaZine' => array(
                                    'id'      => 'submenu_community_mozillazine',
			                        'href'    => "http://www.mozillazine.org/",
                                ),
                                'Planet Mozilla Messaging' => array(
                                    'id'      => 'submenu_community_planet',
			                        'href'    => "http://planet.mozillamessaging.com/",
                                ),
                                'Quality' => array(
                                    'id'      => 'submenu_community_qmo',
			                        'href'    => "http://quality.mozilla.org/",
                                ),
                                'Spread Thunderbird' => array(
                                    'id'      => 'submenu_community_spreadthunderbird',
			                        'href'    => "http://www.spreadthunderbird.com/",
                                )
                            )
                        )
                    ),
                    "{$GLOBALS['__l10n_moz']['About']}"      => array(
                        'id'      => 'menu_aboutus',
                        'href'    => "http://www.mozilla.org/about/",
                    )
                )
            );
        }

        $dynamic_top_menu = buildDynamicTopMenuString($dynamic_top_menu_array, $breadcrumbs);

        // Include the global header.  All locales will include this.
        require "{$config['file_root']}/includes/header.inc.php";

        // Built dynamically in the global header now, to provide consistency across
        // pages.
        echo $dynamic_header;

        unset($dynamic_header);

        unset($dynamic_top_menu);

?>
