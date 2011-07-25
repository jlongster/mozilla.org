<?php

require_once dirname(__FILE__) . '/../simplepie_1.2/simplepie.inc';
require_once dirname(__FILE__) . '/../simplepie_1.2/idn/idna_convert.class.php';
require_once 'MozillaOrg/FeedParser/FavIconHandler.php';

/**
 * This is a feed parser that parses a number of RSS feeds and creates static
 * HTML files for inclusion in your website. Call the file from a cron job
 * every few minutes.
 *
 * LICENSE
 *
 * Version: MPL 1.1/GPL 2.0/LGPL 2.1
 *
 * The contents of this file are subject to the Mozilla Public License Version
 * 1.1 (the "License"); you may not use this file except in compliance with
 * the License. You may obtain a copy of the License at
 * http://www.mozilla.org/MPL/
 *
 * Software distributed under the License is distributed on an "AS IS" basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License
 * for the specific language governing rights and limitations under the
 * License.
 *
 * The Original Code is Mozilla.org feed parser script.
 *
 * The Initial Developer of the Original Code is
 * Patrick Fey <bugzilla@nachtarbeiter.net>.
 * Portions created by the Initial Developer are Copyright (C) 2009
 * the Initial Developer. All Rights Reserved.
 *
 * Contributor(s):
 *
 *  - Michael Gauthier <mike@silverorange.com>
 *
 * Alternatively, the contents of this file may be used under the terms of
 * either the GNU General Public License Version 2 or later (the "GPL"), or
 * the GNU Lesser General Public License Version 2.1 or later (the "LGPL"),
 * in which case the provisions of the GPL or the LGPL are applicable instead
 * of those above. If you wish to allow use of your version of this file only
 * under the terms of either the GPL or the LGPL, and not to allow others to
 * use your version of this file under the terms of the MPL, indicate your
 * decision by deleting the provisions above and replace them with the notice
 * and other provisions required by the GPL or the LGPL. If you do not delete
 * the provisions above, a recipient may use your version of this file under
 * the terms of any one of the MPL, the GPL or the LGPL.
 *
 * You'll need:  PHP5, SimplePie 1.1.3, XMLReader class.
 * Installation: Adjust the path to SimplePie and PHP5 CLI.
 * Usage:        parser.php -c /path/to/config.xml
 *
 * Sample configuration file:
 * <code>
 * <?xml version="1.0"?>
 * <sites>
 *  <site>
 *   <maxitems>4</maxitems>
 *   <target>news.feed.php</target>
 *   <start><![CDATA[<div id="news"><h2 id="latest-news">Latest news from Mozilla <a href="#">View All</a></h2>]]></start>
 *   <end><![CDATA[</div>]]></end>
 *   <item><![CDATA[<div class="section"><p class="date">#date#</p><p class="item"><strong class="title">#title#</strong> #teaser#&hellip; <a href="#permalink#" class="more">Read&nbsp;On</a></p></div>]]></item>
 *   <feeds>
 *    <feed>
 *     <uri>http://blog.mozillafoundation.org/</uri>
 *    </feed>
 *    <feed>
 *     <uri>https://developer.mozilla.org/devnews/index.php/feed/atom/</uri>
 *     <icon>/images/favicons/my-favicon.png</icon>
 *     <filter>!^*.twitter\.com.*$!</filter>
 *    </feed>
 *   </feeds>
 *  </site>
 * </sites>
 * </code>
 *
 * Description of configuration options:
 *  - <kbd>maxitems</kbd>      - Number of items you want on the page.
 *                               (optional)
 *  - <kbd>target</kbd>        - File with static HTML
 *  - <kbd>start</kbd>         - HTML to prepend before the items
 *  - <kbd>end</kbd>           - HTML to append after the items
 *  - <kbd>item</kbd>          - HTML to generate for each item
 *  - <kbd>titlelength</kbd>   - Optional max length of title before it is
 *                               truncated. If not specified, it is not
 *                               truncated.
 *  - <kbd>teaserlength</kbd>  - Optional max length of teaser before it is
 *                               truncated. If not specified, it is truncated
 *                               at 75 characters.
 *  - <kbd>feeds</kbd>         - Feeds to parse
 *  - <kbd>uri</kbd>           - The URI of the feed.
 *  - <kbd>icon</kbd>          - Optional favicon to use for the feed.
 *  - <kbd>filter</kbd>        - Optional regular expression for permalinks
 *                               that should be ignored.
 *
 * Variables for use with the item configuration option:
 *  - <kbd>#author#</kbd>      - Name of the author
 *  - <kbd>#content#</kbd>     - Content of the post (or summary, if
 *                               unavailable)
 *  - <kbd>#description#</kbd> - Summary of the post (or content, if
 *                               unavailable)
 *  - <kbd>#date#</kbd>        - Date of post
 *  - <kbd>#favicon#</kbd>     - URL of favicon image
 *  - <kbd>#permalink#</kbd>   - Permanent link to post
 *  - <kbd>#teaser#</kbd>      - Content stub
 *  - <kbd>#time#</kbd>        - Time of post
 *  - <kbd>#title#</kbd>       - Title of post
 *
 * Exit codes:
 *  - <kbd>0</kbd>             - Success
 *  - <kbd>1</kbd>             - Configuration file problem.
 *  - <kbd>2</kbd>             - Feed problem.
 *  - <kbd>3</kbd>             - Target file problem.
 *  - <kbd>4</kbd>             - Dependency problem.
 *
 * @package   MozillaOrg
 * @author    Patrick Fey <bugzilla@nachtarbeiter.net>
 * @author    Michael Gauthier <mike@silverorange.com>
 * @copyright 2009 Patrick Fey
 * @license   http://www.mozilla.org/MPL/ Mozilla Public License
 */
class MozillaOrg_FeedParser
{
    protected $favIconHandler = null;

    public function run()
    {
        $this->checkParameters();
        $this->checkDependencies();
        $sites = $this->loadConfig();
        $this->parse($sites);
        exit(0);
    }

    public function setFavIconHandler(
        MozillaOrg_FeedParser_FavIconHandler $handler)
    {
        $this->favIconHandler = $handler;
    }

    protected function checkParameters()
    {
        if (!isset($_SERVER['argc'])) {
            $this->notice(
                "Fatal error: This is a command line script. Use the CLI " .
                "version of PHP for execution."
            );
        }

        if (($_SERVER['argc'] != 3) || ($_SERVER['argv'][1] != '-c')) {
            $this->notice(
                "Usage: {$_SERVER['argv'][0]} -c /path/to/config.xml\n"
            );
        }

        if (   !file_exists($_SERVER['argv'][2])
            && !is_file($_SERVER['argv'][2])
        ) {
            $this->error(
                "Unable to open configuration file. Supplied configuration " .
                "file doees not exist or is not a file.\n",
                1
            );
        }

        if (!is_readable($_SERVER['argv'][2])) {
            $this->error(
                "Unable to open configuration file. Configuration file not " .
                "readable.\n",
                1
            );
        }
    }

    protected function checkDependencies()
    {
        if (!class_exists('SimplePie')) {
            $this->error(
                "Unable to find SimplePie class. Maybe you forgot to adjust " .
                "the path?\n",
                4
            );
        }

        if (!extension_loaded('xmlreader')) {
            $this->error("Unable to find XMLReader PHP extension.\n", 4);
        }

        if (!extension_loaded('curl')) {
            $this->error("Unable to find CURL PHP extension.\n", 4);
        }
    }

    protected function loadConfig()
    {
        // node-name => optional
        static $siteOptions = array(
            'target'       => false,
            'start'        => false,
            'end'          => false,
            'item'         => false,
            'maxitems'     => true,
            'titlelength'  => true,
            'teaserlength' => true,
        );

        // node-name => optional
        static $feedOptions = array(
            'uri'          => false,
            'icon'         => true,
            'filter'       => true,
        );

        $sites = array();

        $document = new DOMDocument();
        if (!$document->load($_SERVER['argv'][2])) {
            $this->error("Unable to open configuration file.\n", 1);
        }

        $xpath = new DOMXPath($document);

        $siteNodes = $xpath->query('//sites/site');
        foreach ($siteNodes as $siteNode) {

            $valid = true;
            $site  = array();

            // parse site options
            foreach ($siteOptions as $nodeName => $optional) {
                $value = $xpath->evaluate(
                    'string(' . $nodeName . '/text())',
                    $siteNode
                );

                // check for required options
                if (!$value && !$optional) {
                    $valid = false;
                    break;
                }

                $site[$nodeName] = $value;
            }

            // parse feeds for the site
            $site['feeds'] = array();
            $feedNodes = $xpath->query('feeds/feed', $siteNode);
            foreach ($feedNodes as $feedNode) {

                $validFeed = true;
                $feed      = array();

                // parse feed options
                foreach ($feedOptions as $nodeName => $optional) {
                    $value = $xpath->evaluate(
                        'string(' . $nodeName . '/text())',
                        $feedNode
                    );

                    if (!$value && !$optional) {
                        $validFeed = false;
                        break;
                    }

                    $feed[$nodeName] = $value;
                }

                if ($validFeed) {
                    $site['feeds'][$feed['uri']] = $feed;
                }
            }

            if (count($site['feeds']) === 0) {
                $valid = false;
            }

            if ($valid) {
                $sites[] = $site;
            }
        }

        return $sites;
    }

    protected function parse(array $sites)
    {
        foreach ($sites as $site) {
            $this->parseSite($site);
        }
    }

    protected function parseSite(array $site)
    {
        $feed = new SimplePie();
        $feed->enable_cache(true);
        $feed->set_cache_location(
            dirname(__FILE__) . '/../../cache/simplepie'
        );
        $feed->set_feed_url(array_keys($site['feeds']));
        $feed->init();

        if ($feed->error) {
            $this->error(
                "Unable to read feed. SimplePie said:" . $feed->error() . "\n",
                2
            );
        }

        $fp = @fopen($site['target'], 'w');
        if (!$fp) {
            $this->error("Unable to open target file.\n", 3);
        }

        fwrite($fp, $site['start']);

        $count = 1;
        foreach ($feed->get_items() as $item) {

            // we're checking maxitems here instead of just passing to the
            // get_items() method because some items may be filtered
            if ($count > $site['maxitems']) {
                break;
            }

            $thisFeed      = $item->get_feed();
            $thisPermalink = $item->get_permalink();

            // check if item should be filtered
            if (   isset($site['feeds'][$thisFeed->feed_url])
                && $site['feeds'][$thisFeed->feed_url]['filter']
            ) {
                $filter = $site['feeds'][$thisFeed->feed_url]['filter'];
                if (preg_match($filter, $thisPermalink) === 1) {
                    continue;
                }
            }

            $thisAuthor      = $item->get_author()->get_name();
            $thisContent     = $item->get_content();
            $thisDate        = $item->get_date('d M Y');
            $thisDescription = $item->get_description();
            $thisTime        = $item->get_date('g:i a');
            $thisFavIcon     = $this->getFavIcon($item);

            if ($site['teaserlength']) {
                $thisTeaser = $this->truncate(
                    $item->get_description(),
                    $site['teaserlength']
                );
            } else {
                $thisTeaser = $this->truncate($item->get_description(), 75);
            }

            if ($site['titlelength']) {
                $thisTitle = $this->truncate(
                    $item->get_title(),
                    $site['titlelength']
                );
            } else {
                $thisTitle = $item->get_title();
            }

            $output = $site['item'];

            $output = str_replace(
                array(
                    '#author#',
                    '#content#',
                    '#date#',
                    '#description#',
                    '#favicon#',
                    '#permalink#',
                    '#teaser#',
                    '#time#',
                    '#title#',
                    '#author#'
                ),
                array(
                    $thisAuthor,
                    $thisContent,
                    $thisDate,
                    $thisDescription,
                    $thisFavIcon,
                    $thisPermalink,
                    $thisTeaser,
                    $thisTime,
                    $thisTitle
                ),
                $output
            );

            fwrite($fp, $output);

            $count++;
        }

        fwrite($fp, $site['end']);

        fclose($fp);
    }

/**
 * Truncates text.
 *
 * CakePHP(tm) : Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Originally licensed under The MIT License
 *
 * Cuts a string to the length of $length and replaces the last characters
 * with the ending if the text is longer than length.
 *
 * @param string  $text String to truncate.
 * @param integer $length Length of returned string, including ellipsis.
 * @param string  $ending Ending to be appended to the trimmed string.
 * @param boolean $exact If false, $text will not be cut mid-word
 * @param boolean $considerHtml If true, HTML tags would be handled correctly
 * @return string Trimmed string.
 */
    protected function truncate($text, $length = 100, $ending = "\xc2\xa0\xe2\x80\xa6", $exact = false, $considerHtml = true) {
	// collapse whitespace
	$text = preg_replace('/\s+/', ' ', $text);
	$text = trim($text);

	if ($considerHtml) {
		// if the plain text is shorter than the maximum length, return the whole text
		if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
			return $text;
		}
		// splits all html-tags to scanable lines
		preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);
		$total_length = strlen($ending);
		$open_tags = array();
		$truncate = '';
		foreach ($lines as $line_matchings) {
			// if there is any html-tag in this line, handle it and add it (uncounted) to the output
			if (!empty($line_matchings[1])) {
				// if it's an "empty element" with or without xhtml-conform closing slash (f.e. <br/>)
				if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
					// do nothing
				// if tag is a closing tag (f.e. </b>)
				} else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
					// delete tag from $open_tags list
					$pos = array_search($tag_matchings[1], $open_tags);
					if ($pos !== false) {
						unset($open_tags[$pos]);
					}
				// if tag is an opening tag (f.e. <b>)
				} else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
					// add tag to the beginning of $open_tags list
					array_unshift($open_tags, strtolower($tag_matchings[1]));
				}
				// add html-tag to $truncate'd text
				$truncate .= $line_matchings[1];
			}
			// calculate the length of the plain text part of the line; handle entities as one character
			$content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
			if ($total_length+$content_length> $length) {
				// the number of characters which are left
				$left = $length - $total_length;
				$entities_length = 0;
				// search for html entities
				if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
					// calculate the real length of all entities in the legal range
					foreach ($entities[0] as $entity) {
						if ($entity[1]+1-$entities_length <= $left) {
							$left--;
							$entities_length += strlen($entity[0]);
						} else {
							// no more characters left
							break;
						}
					}
				}
				$truncate .= substr($line_matchings[2], 0, $left+$entities_length);
				// maximum lenght is reached, so get off the loop
				break;
			} else {
				$truncate .= $line_matchings[2];
				$total_length += $content_length;
			}
			// if the maximum length is reached, get off the loop
			if($total_length>= $length) {
				break;
			}
		}
	} else {
		if (strlen($text) <= $length) {
			return $text;
		} else {
			$truncate = substr($text, 0, $length - strlen($ending));
		}
	}
	// if the words shouldn't be cut in the middle...
	if (!$exact) {
		// ...search the last occurance of a space...
		$spacepos = strrpos($truncate, ' ');
		if (isset($spacepos)) {
			// ...and cut the text in this position
			$truncate = substr($truncate, 0, $spacepos);
		}
	}
	// add the defined ending to the text
	$truncate .= $ending;
	if($considerHtml) {
		// close all unclosed html-tags
		foreach ($open_tags as $tag) {
			$truncate .= '</' . $tag . '>';
		}
	}
	return $truncate;
    }

    protected function getFavIcon(SimplePie_Item $item)
    {
        if ($this->favIconHandler instanceof MozillaOrg_FeedParser_FavIconHandler) {
            $favIcon = $this->favIconHandler->getFavIcon($item);
        } else {
            $feed = $item->get_feed();
            if (   isset($site['feeds'][$feed->feed_url])
                && $site['feeds'][$feed->feed_url]['icon']
            ) {
                $favIcon = $site['feeds'][$feed->feed_url]['icon'];
            } else {
                $favIcon = $feed->get_favicon();
            }
        }

        return $favIcon;
    }

    protected function strrpos($text, $needle)
    {
        if (extension_loaded('mbstring')) {
            if (version_compare(PHP_VERSION, '5.2.0', 'ge')) {
                return mb_strrpos($text, $needle, 0, 'utf-8');
            }
            return mb_strrpos($text, $needle, 'utf-8');
        }

        return strrpos($text, $needle);
    }

    protected function strlen($text)
    {
        if (extension_loaded('mbstring')) {
            return mb_strlen($text, 'utf-8');
        }

        return strlen($text);
    }

    protected function substr($text, $start, $length)
    {
        if (extension_loaded('mbstring')) {
            return mb_substr($text, $start, $length, 'utf-8');
        }

        return substr($text, $start, $length);
    }

    protected function error($message, $code = 1)
    {
        fwrite(STDERR, $message);
        exit($code);
    }

    protected function notice($message, $code = 0)
    {
        fwrite(STDOUT, $message);
        exit($code);
    }
}

?>
