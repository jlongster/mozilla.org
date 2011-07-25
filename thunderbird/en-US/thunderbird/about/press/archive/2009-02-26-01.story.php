<?php
/**
 * News story template
 *
 * See ../README.txt for info on how to create/update news stories
 */

$story_title = <<<TITLE
Thunderbird 3 Beta 2 is Now Available
TITLE;

$story_date = '2009-02-26';

$story_snippet = <<<SNIPPET
The second beta of Thunderbird 3 is available for testing.
SNIPPET;

$faq_link = url('/news/faq/2009-02-26-01');
$beta2_link = url('/thunderbird/3.0b2/');
$releasenotes_30b2_link = url('/thunderbird/3.0b2/releasenotes/');

$story_body = <<<BODY
<p>February 26, 2009</p>

<p>We're happy to announce the release of <a href="$beta2_link">Thunderbird 3 Beta 2</a>, now available for download.</p>

<p>Thunderbird 3 Beta 2 is available for testers, extension developers, and other people who are curious to follow the
development of the next release of Thunderbird.  This milestone is focused on testing the core functionality of the new features and platform changes that will be included in Thunderbird 3.</p>

<p>Thunderbird 3 Beta 2 includes several new features that build on the current <a href="http://www.mozillamessaging.com/en-US/thunderbird/all.html">Thunderbird 2</a>.  We expect to release an additional
beta release as we work towards a major new release of Thunderbird 3.</p>

<p>Please read the <a href="$releasenotes_30b2_link">release notes</a> for more details.</p>
BODY;

?>
