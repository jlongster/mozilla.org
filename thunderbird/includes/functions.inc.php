<?php
/**
 * Returns absolute URL to the specified file or folder.
 *
 * @param string $file The path to the file, ex: '/about/thunderbird'
 * @param bool $addon_locale Whether the current locale should be included
 *                          in the URL. For example, images and CSS should
 *                          not have the locale. If left empty, add_locale
 *                          will attempt to be detected based on the file
 *                          extension.
 * @returns string
 */
function url($file, $add_locale = null) {
    // Add beginning slash if left out
    if ($file[0] != '/')
        $file = '/'.$file;
    
    // Get base URL
    $url = get_base_url();
    
    // If add_locale is empty, try to detect whether it should be used
    if (!isset($add_locale)) {
        $static_extensions = array('jpg', 'png', 'gif', 'css', 'js');
        
        if ($last_position = strrpos($file, '.')) {
            $extension = substr($file, $last_position + 1);
            
            $add_locale = !in_array($extension, $static_extensions);
        }
        else
            $add_locale = true;
    }
    
    // Add the locale if necessary
    if ($add_locale)
        $url .= '/'.LANG;
    
    $url .= $file;
    
    return $url;
}

/**
 * Returns the current base URL, such as
 *             /mozillamessaging.com/trunk
 *
 * @returns string
 */
function get_base_url() {
    $path = substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], LANG) - 1);
    
    return $path;
}

/**
 * Generate breadcrumbs HTML
 *
 * @returns string
 */
function breadcrumbs() {
    global $breadcrumbs;
    $crumbs = array();
    
    if (!empty($breadcrumbs)) {
        foreach ($breadcrumbs as $title => $link) {
            $crumbs[] = '<a href="'.url($link).'">'.$title.'</a>';
        }
    }
    
    $html = '<div id="breadcrumbs">';
    $html .= implode('&nbsp;&raquo;&nbsp;', $crumbs);
    $html .= '</div>';
    return $html;
}

/**
 * If the string exists in the language cache, return it, otherwise return what was
 * given to us. The language cache is build in the l10n_moz class
 */
function ___($str)
{
	return (!empty($GLOBALS['__l10n_moz'][$str])) ? $GLOBALS['__l10n_moz'][$str] : $str;
}


function isUpToDate($product_localized, $product_en)
{
    if ($product_localized->getLang() == 'en')
    {
        return true;
    }

    $version = $product_localized->getVersion();
    $version_en = $product_en->getVersion();

    return strcasecmp($product_localized->getVersion(), $product_en->getVersion()) == 0;
}

function is_num($var)
{
    $len = strlen($var);

    for ($i = 0; $i < $len; $i++)
    {
        $code = ord($var[$i]);

        # all numeric chars
        # all op chars
        # space
        if ($code < 32 || $code > 57)
            return false;
    }

    return true;
}

function printPlatformDownloadLink($product)
{
    if ($product['en']->name == 'Camino') {
        $platform = 'macosx';
    }
    else {
        $useragent = $_SERVER['HTTP_USER_AGENT'];
        if (strstr($useragent, 'Win')) {
            $platform = 'win32';
        }
        else if (strstr($useragent, 'Linux')) {
            $platform = 'linux';
        }
        else if (strstr($useragent, 'Mac OS X')) {
            $platform = 'macosx';
        }
        else {
            return;
        }
    }

    if (!$product[LANG]->hasPlatformBinary($platform)) {
        $product['en']->printDownloadLink($platform, true, true);
    }
    else if (isUpToDate($product[LANG], $product['en'])) {
        $product[LANG]->printDownloadLink($platform, true, false);
    }
    else {
        $product['en']->printDownloadLink($platform, true, true);
        echo ', ';
        $product[LANG]->printDownloadLink($platform, true, true);
    }
    //echo ', ';
}

/**
 * Look up the language in our language name array and return the value
 *
 * @param string $lang language
 */
function getLangTitle($lang)
{                                                                                                                                                                                                                                     
    // In the config - the html'ized names of our languages
    global $native_languages;

    if (array_key_exists($lang, $native_languages)) {
        return $native_languages[$lang];
    } else {
        return '';
    }

}                                                                                                                                                                                                                                     

/**
 * Used when echoing out the language links in the footer. Will return a single
 * string, either an <a> or <span>
 *
 * @param $lang string language (eg. 'en-US')
 * @param $exclude_current_lang boolean if true, the current language (in LANG) will
 *          not have <a> tags, but instead <span>
 * @param $add_suffix boolean if true, will automatically append the current page to
 *          links. (eg. If they are on /products/index.html that will be appended to
 *          all links.)
 */
function createLangLink($lang, $exclude_current_lang=true, $add_suffix=true)
{                                                                                                                                                                                                                                     
    global $config;

    $suffix = '';
    if ($add_suffix) {
        // Strip $config['directory_index'] from the URL, if present
        $suffix = (strstr($_SERVER['REDIRECT_URL'], $config['directory_index'])) ? dirname($_SERVER['REDIRECT_URL']) : $_SERVER['REDIRECT_URL'];
    }

    if ($exclude_current_lang) {
        if ($lang == LANG) {
            return "<span>{$lang}</span>";
        }
    }
                                                                                                                                                                                                                                      
    $link = "{$config['url_scheme']}://{$lang}.{$config['server_name']}/{$lang}{$suffix}";

    // Get our title - if we have it, put title="" around it.
    $title = getLangTitle($lang);
    $title = empty($title) ? '' : 'title="'.$title.'"';

    return '<a hreflang="' . $lang . '" ' . $title . ' href="' . $link .  '">' . $lang . '</a>';
}

/**
 * Generate a list of languages (useful for footer links)
 */
function getLangLinksList() 
{
    // From the main config - this is all of the languages we support
    global $full_languages;

    // Generate our list
    $lang_list = implode("</dd>\n <dd>", array_map('createLangLink', $full_languages));

    return "\n<dd>{$lang_list}</dd>\n";

}


/**
 * Generate a list of languages (useful for footer links)
 */
function getLangLinksSelect() 
{
    // From the main config - these are the languages we want in the dropdown
    global $language_select_list;

    $_select_string = '';

    foreach ($language_select_list as $lang => $fullname) {

        // Find our current language in the list, and make it the selected option.
        $_selected = ($lang == LANG) ? ' selected="selected"' : '';
        $_value    = 'value="'.$lang.'"';

        $_select_string .= "    <option {$_value}{$_selected}>{$fullname}</option>\n";

    }


    return "\n<select id=\"flang\" name=\"flang\" dir=\"ltr\" onchange=\"this.form.submit()\">{$_select_string}</select>\n";

}

/**
 * Builds a breadcrumb string.  If an href is empty, it's assumed that it is the last
 * in the line of breadcrumbs and is surrounded by a <span> instead of an <a> and is
 * not followed by a raquo
 *
 * @param array breadcrumb string in this format:
 *      array(
 *          'title' => 'href',
 *          'title' => 'href',
 *          ...
 *           )
 * @return string HTML that represents the breadcrumbs, eg:
 * 
 */
function buildBreadcrumbString($breadcrumbs)
{
    if (!is_array($breadcrumbs)) {
        return '';
    }

    $_breadcrumb_link_string = '';

    foreach ($breadcrumbs as $title => $href) {
        if (empty($href)) {
            $_breadcrumb_link_string .= "<span>{$title}</span>";
        } else {
            $_breadcrumb_link_string .= "<a href=\"{$href}\">{$title}</a> &#187; ";
        }
    }

    return $_breadcrumb_link_string;
}

/**
 * This function was created to highlight the link on the nav menu when the user is
 * viewing a page underneath it.  It keys off the breadcrumbs array to figure out
 * where it is in the site.  This is called in the per-lang header.
 *
 * @param array dynamic top menu array in the form:
 *      array (
 *       'title' => array(
 *                       'list-id' => 'menu_title',
 *                       'href'    => 'http://www.mozilla.com/',
 *                       'submenu' => array( ... )
 *                       ),
 *          ...
 *       )
 *
 * @param array breadcrumb array, form is defined in comments for buildBreadcrumbString()
 * @return string HTML text representing the menu
 */
function buildDynamicTopMenuString($dynamic_top_menu, $breadcrumbs)
{
    ob_start();

    if (is_array($dynamic_top_menu) && !empty($dynamic_top_menu)) {
        $dynamic_top_menu['id'] = 'nav-main'; // top level must be nav-main
        echo "\n<!-- start #nav-main -->\n";
        echo buildDynamicTopMenuRecursive($dynamic_top_menu, $breadcrumbs);
        echo "<!-- end #nav-main -->\n";
    }

    return ob_get_clean();
}

function buildDynamicTopMenuRecursive($menu, $breadcrumbs, $level = 0)
{
    $_padding = str_repeat('      ', $level);

    ob_start();

    // If it's not an array, we're going to skip all this.  Checks for the $breadcrumb
    // array is unnecessary since we're using array_key_exists()
    if (is_array($menu) && !empty($menu)) {
        $_div_id = (empty($menu['id'])) ? '' : " id=\"{$menu['id']}\"";
        $_div_class = ($level == 0) ? ' class="yuimenubar yuimenubarnav"' : ' class="yuimenu"';
        $_ul_class = ($level == 0) ? ' class="first-of-type"' : '';

        echo "{$_padding}<div{$_div_id}{$_div_class}>\n";
        echo "{$_padding}  <div class=\"bd\">\n";
        echo "{$_padding}    <ul{$_ul_class}>\n";

        if (is_array($menu['items']) && !empty($menu['items'])) {
            foreach ($menu['items'] as $name => $attributes) {

                // Just in case it's empty, we don't want a bunch of id="" on the page
                $_li_id = empty($attributes['id']) ? '' : " id=\"{$attributes['id']}\"";
				$_li_class = ($level == 0) ? ' class="yuimenubaritem"' : ' class="yuimenuitem"';

                echo "<li{$_li_id}{$_li_class}>";

                // If the key exists in the breadcrumbs we'll use it to determine if
                // we're on the page or not
                if (array_key_exists($name, $breadcrumbs)) {

                    // If it exists, but is empty, we're currently on that page.
                    if (empty($breadcrumbs[$name])) {
                        echo "<span class=\"current\">{$name}</span>";
                    } else {
                    // It exists, but isn't empty, we're beneath that page
                        echo "<a class=\"current\" href=\"{$attributes['href']}\">{$name}</a>";
                    }

                } else {
                    // It doesn't exist in the breadcrumbs.  Just put a normal link up
                    echo "<a href=\"{$attributes['href']}\">{$name}</a>";
                }

                if (array_key_exists('submenu', $attributes)) {
                    echo "\n", buildDynamicTopMenuRecursive($attributes['submenu'], $breadcrumbs, $level + 1), "{$_padding}      ";
                }

                echo "</li>";
            }
        }

        echo "</ul>\n";
        echo "{$_padding}  </div>\n";
        echo "{$_padding}</div>\n";
    }

    return ob_get_clean();
}


/**
 * Generates a download box for Firefox in-product pages
 */

function secondaryDownloadBox($lang)
{
	?>
    <script type="text/javascript" src="/js/old/download.js"></script>
    <script type="text/javascript">
        <!--
        // Configure the Firefox download write script
        var gDownloadItemTemplate = " <li class=\"%CSS_CLASS%\"> <h3><?=$GLOBALS['__l10n_moz']['Get Firefox 3']?><\/h3><div>%VERSION% for %PLATFORM_NAME%<br \/> %LANGUAGE_NAME%&nbsp;(%FILE_SIZE%)<\/div><a onclick=\"javascript:do_download('%BOUNCER_URL%');\" href=\"%DOWNLOAD_URL%\" class=\"download-link download-firefox\"><span class=\"download-link-text\">Download Firefox<span class=\"free\"> - Free<\/span><\/span><\/a><\/li>";
        var gDownloadItemMacOS9 = "<a href=\"\">MacOS 9 and earlier are not supported<\/a>";
        var gDownloadItemOtherPlatform = "<a href=\"/<?=$lang?>/firefox/<?=LATEST_FIREFOX_VERSION?>/releasenotes/#contributedbuilds\">Free Download<\/a>"

        document.writeln("<ul class=\"download download-firefox " + gCssClass + " \">");
        writeDownloadItems("fx");
        document.writeln("<\/ul>");
        document.writeln("<div class=\"download-other\"><span class=\"other\">");
        document.writeln("<a href=\"\/<?=$lang?>\/firefox\/<?=LATEST_FIREFOX_VERSION?>\/releasenotes\/\">Release Notes<\/a>");
        document.writeln("| <a href=\"\/<?=$lang?>\/firefox\/all.html\">Other Systems and Languages<\/a>");
        document.writeln("<\/span><\/div>");
        //-->
    </script>
	<?
}


/**
 * Generates inline JavaScript for displaying a platform-specific screenshot
 * image
 *
 * A suitable noscript tag containing the default image tag (Vista) is also
 * returned.
 *
 * Also note, the utils.js script should be included in the document head for
 * the JavaScript generated by this function to work correctly.
 *
 * @param string  $filename  the original filename (Windows version).
 * @param string  $alt       the alt text.
 * @param integer $width     optional. The image width.
 * @param integer $height    optional. The image height.
 * @param string  $class     optional. CSS class to apply to the image.
 * @param array   $platforms optional. Array of extra platforms. Valid extra
 *                           platforms are: 'mac', 'linux' and 'xp'. By default,
 *                           the extra platform 'mac' is used. Vista is the
 *                           fallback platform for all images. If no extra
 *                           platforms are specified, a simple image tag is
 *                           displayed.
 *
 * @return string a piece of inline JavaScript that can be used to display a
 *                platform-specific screenshot for the given parameters.
 */
function buildPlatformImage($filename, $alt, $width = null, $height = null,
	$class = null, $platforms = array('mac'))
{
	$valid_platforms = array('mac', 'linux', 'xp');
	$platforms = array_intersect($valid_platforms, $platforms);

	// maps platforms to JavaScript boolean expressions
	$platform_conditional = array(
		'mac'     => 'gPlatform == PLATFORM_MACOSX',
		'linux'   => 'gPlatform == PLATFORM_LINUX',
		'xp'      => '!gPlatformVista',
	);

	$filename = minimizeEntities($filename);
	$filename = escapeForJavaScript($filename);

	$alt = minimizeEntities($alt);
	$alt = escapeForJavaScript($alt);
	$alt = str_replace('%', '%%', $alt);

	// build image tag template
	$image_template = '<img src="%s" alt="' . $alt .'"';
	if (is_int($width)) {
		$image_template.= ' width="' . $width . '"';
	}
	if (is_int($height)) {
		$image_template.= ' height="' . $height . '"';
	}
	if (is_string($class)) {
		$class = minimizeEntities($class);
		$class = escapeForJavaScript($class);
		$class = str_replace('%', '%%', $class);
		$image_template.= ' class="' . $class . '"';
	}
	$image_template.= ' />';

	// build platform-specific image tags
	$filename_exp = explode('.', $filename);
	$extension = array_pop($filename_exp);
	$base = implode('.', $filename_exp);
	foreach ($platforms as $platform) {
		$platform_filename = $base . '-' . $platform . '.' . $extension;
		$platform_image[$platform] =
			sprintf($image_template, $platform_filename);
	}

	$default_image = sprintf($image_template, $filename);

	ob_start();

	if (count($platforms) === 0) {
		echo $default_image;
	} else {
		echo '<script type="text/javascript">// <![CDATA[', "\n";

		foreach ($platforms as $index => $platform) {
			if ($index == 0) {
				printf("if (%s) {\n\tdocument.write('%s');\n",
					$platform_conditional[$platform],
					$platform_image[$platform]);
			} else {
				printf("} else if (%s) {\n\tdocument.write('%s');\n",
					$platform_conditional[$platform],
					$platform_image[$platform]);
			}
		}

		printf("} else {\n\tdocument.write('%s');\n}\n",
			$default_image);

		echo '// ]]></script><noscript><div style="display: inline;">',
			$default_image,
			"</div></noscript>";
	}

	return ob_get_clean();
}

/**
 * Converts a UTF-8 text string to have the minimal number of entities
 * necessary to output it as valid UTF-8 XHTML without ever double-escaping.
 *
 * The text is converted as follows:
 *
 * - any exisiting entities are decoded to their UTF-8 characaters
 * - the minimal number of characters necessary are then escaped as entities:
 *         ampersands (&) => &amp;
 *          less than (<) => &lt;
 *       greater than (>) => &gt;
 *	     double quote (") => &quot;
 *
 * Code lifted with permission from SwatString (http://swat.silverorange.com).
 *
 * @param string $text the UTF-8 text string to convert.
 *
 * @return string the UTF-8 text string with minimal entities.
 */
function minimizeEntities($text)
{
	// decode any entities that might already exist
	$text = html_entity_decode($text, ENT_COMPAT, 'UTF-8');

	// encode all ampersands (&), less than (<), greater than (>),
	// and double quote (") characters as their XML entities
	$text = htmlspecialchars($text, ENT_COMPAT, 'UTF-8');

	return $text;
}

/**
 * Safely escapes a PHP string into a JavaScript string
 *
 * The following rules are applied to prevent XSS attacks:
 *
 * - JavaScript string escape characters in the PHP string are escaped.
 * - Quotation marks in the PHP string are escaped.
 * - Closing script tags in the PHP string are broken into separate
 *   JavaScript strings.
 * - Closing CDATA triads are broken into multiple JavaScript strings.
 *
 * Implementation taken with permission from SwatString
 * (http://swat.silverorange.com).
 *
 * @param string  $string the PHP string to escape as a JavaScript string.
 * @param string  $quotes the quotation mark character used for the string.
 *                        Defaults to single quotes.
 * @param boolean $cdata  whether or not to escape CDATA tridents. Defaults to
 *                        true.
 *
 * @return string the escaped JavaScript string. The escaped string is safe to
 *                include in inline JavaScript.
 */
function escapeForJavaScript($string, $quotes = "'", $cdata = true)
{
	// escape escape characters
	$string = str_replace('\\', '\\\\', $string);

	// escape quotes
	$string = str_replace($quotes, '\\'.$quotes, $string);

	// break closing script tags
	$string = preg_replace('/<\/(script)([^>]*)?>/ui',
		"</\\1' + '\\2>", $string);

	// escape CDATA closing triads (if specified)
	if ($cdata) {
		$string = str_replace(']]>', "' +\n//]]>\n']]>' +\n//<![CDATA[\n'",
			$string);
	}

	return $string;
}

function data_url($file, $mime) {
  $contents = file_get_contents($file);
  $base64   = base64_encode($contents);
  return ('data:' . $mime . ';base64,' . $base64);
}


?>
