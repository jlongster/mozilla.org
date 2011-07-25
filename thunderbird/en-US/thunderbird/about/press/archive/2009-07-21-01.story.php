<?php
/**
 * News story template
 *
 * See ../README.txt for info on how to create/update news stories
 */

$story_title = <<<TITLE
Thunderbird 3 Beta 3 is Available For Download
TITLE;

$story_date = '2009-07-21';

$story_snippet = <<<SNIPPET
The third beta of Thunderbird 3 is available for testing.
SNIPPET;

$faq_link = url('/news/faq/2009-07-21-01');
$beta3_link = url('/thunderbird/3.0b3/');
$releasenotes_30b3_link = url('/thunderbird/3.0b3/releasenotes/');

$story_body = <<<BODY
<p>July 21, 2009</p>

<p>We're happy to announce the release of <a href="$beta3_link">Thunderbird 3 Beta 3</a>, now available for download.</p>

<p>Thunderbird 3 Beta 3 is available for testers, extension developers, and other people who are curious to follow the
development of the next release of Thunderbird.  This milestone is focused on testing the core functionality of the new features and platform changes that will be included in Thunderbird 3.</p>

<p>Thunderbird 3 Beta 3 includes several enhancements for developers that build on the current <a href="http://www.mozillamessaging.com/en-US/thunderbird/all.html">Thunderbird 2</a>.  We expect to release additional
beta releases as we work towards a major new release of Thunderbird 3.</p>

<p>Please read the <a href="$releasenotes_30b3_link">release notes</a> for more details.</p>
BODY;

?>
