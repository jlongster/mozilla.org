<?php
/**
 * News story template
 *
 * See ../README.txt for info on how to create/update news stories
 */

$story_title = <<<TITLE
First Rapid Release of Thunderbird Beta Now Available
TITLE;

$story_date = '2011-06-02';

$story_snippet = <<<SNIPPET
New Thunderbird Beta is available for free download
SNIPPET;

$faq_link = url('/news/faq/2011-06-02-01');
$download_link = 'http://www.mozillamessaging.com/en-US/thunderbird/early_releases/downloads/';
$releasenotes_5_link = url('/thunderbird/5.0b1/releasenotes/');


$story_body = <<<BODY
<p>June 2, 2011</p>

<p>Mozilla is pleased to release a new Thunderbird Beta for <a href="$download_link">download</a> and testing.</p>

<p>While this milestone is considered to be stable, it is intended for developers and members of our testing community to use for evaluation and feedback. Users of this latest beta version of Thunderbird should not expect all of their add-ons to work properly with this milestone.</p>

<p>Notable changes in Thunderbird Beta include: a new Addons Manager and Extension management API, Tab enhancements, revised account creation wizard to improve email setup, new troubleshooting infromation page, and several user interface fixes and improvements.</p>

<p>For a list of additional changes and more information, please review the Thunderbird Beta <a href="$releasenotes_5_link">release notes</a> and <a href="https://wiki.mozilla.org/Releases/Thunderbird/Channels/Beta/FAQ/">FAQ</a>.</p>

<p>Thanks to Thunderbird Beta testers for being a crucial part of refining and preparing the next version of Thunderbird for our millions of users worldwide.</p>

<p>Testers can download Thunderbird Beta for Windows, Mac OS X, and Linux in 24 different languages. Community chat about Thunderbird Beta can be followed on irc.mozilla.org in #thunderbird.</p>


BODY;


?>
