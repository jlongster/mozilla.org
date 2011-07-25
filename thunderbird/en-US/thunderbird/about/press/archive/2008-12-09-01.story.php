<?php
/**
 * News story template
 *
 * See ../README.txt for info on how to create/update news stories
 */

$story_title = <<<TITLE
Thunderbird 3 Beta 1 is here
TITLE;

$story_date = '2008-12-09';

$story_snippet = <<<SNIPPET
The first beta of Thunderbird 3 is now available for testing.
SNIPPET;

$faq_link = url('/news/faq/2008-02-19-01');
$beta1_link = url('/thunderbird/3.0b1/');
$releasenotes_30b1_link = url('/thunderbird/3.0b1/releasenotes/');

$story_body = <<<BODY
<p>December 9, 2008</p>

<p>We're happy to announce the release of <a href="$beta1_link">Thunderbird 3 Beta 1</a>, now available for download.</p>

<p>Thunderbird 3 Beta 1 is available for testers, extension developers, and other people who are curious to follow the
development of the next release of Thunderbird.  This milestone is focused on testing the core functionality of the new features and platform changes that will be included in Thunderbird 3.</p>

<p>Thunderbird 3 Beta 1 includes several new features that build on the current <a href="http://www.mozilla.com/en-US/thunderbird/all.html">Thunderbird 2</a>.  We expect to release further
beta releases as we work towards a major new release of Thunderbird 3.</p>

<p>Please read the <a href="$releasenotes_30b1_link">release notes</a> for more details.</p>
BODY;

?>
