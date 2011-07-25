<?php
/**
 * News story template
 *
 * See ../README.txt for info on how to create/update news stories
 */

$story_title = <<<TITLE
Thunderbird 3 Beta 4 is Now Available
TITLE;

$story_date = '2009-09-22';

$story_snippet = <<<SNIPPET
The fourth beta of Thunderbird 3 is now available for testing.
SNIPPET;

$faq_link = url('/news/faq/2009-09-22-01');
$beta4_link = url('/thunderbird/early_releases/downloads/');
$releasenotes_30b3_link = url('/thunderbird/3.0b4/releasenotes/');

$story_body = <<<BODY
<p>September 22, 2009</p>

<p>We're happy to announce the release of <a href="$beta4_link">Thunderbird 3 Beta 4</a>, now available for download.</p>

<p>Thunderbird 3 Beta 4 is available for testers, extension developers, and other people who are curious to follow the
development of the next release of Thunderbird.  This milestone is focused on testing the core functionality of the new features and platform changes that will be included in Thunderbird 3.</p>

<p>Thunderbird 3 Beta 4 includes several new features like Tabbed email and Advanced Search tools that build on the current <a href="http://www.mozillamessaging.com/en-US/thunderbird/">Thunderbird 2</a>. </p>

<p>Please read the <a href="$releasenotes_30b3_link">release notes</a> for more details.</p>
BODY;

?>
