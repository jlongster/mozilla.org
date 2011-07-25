<?php
/**
 * News story template
 *
 * See ../README.txt for info on how to create/update news stories
 */

$story_title = <<<TITLE
Second Alpha of Next version of Thunderbird available
TITLE;

$story_date = '2008-07-13';

$story_snippet = <<<SNIPPET
A new early version of next version of Thunderbird is ready for testing.
SNIPPET;

$faq_link = url('/news/faq/2008-02-19-01');
$early_releases_link = url('/thunderbird/early_releases/');
$releasenotes_30a2_link = url('/thunderbird/3.0a2/releasenotes/');

$story_body = <<<BODY
<p>August 12, 2008</p>

<p>We're happy to announce the second early release
of the next version of Thunderbird.</p>

<p>This release, called Shredder a2 to emphasize its early
nature and the need for caution, is available from the
<a href="$early_releases_link">mozillamessaging.com</a> for testers,
extension developers, and other people who are curious to follow the
development of the next release of Thunderbird.</p>

<p>This release has few functionality changes compared to the current release
of Thunderbird (<a href="/en-US/thunderbird/all.html">2.0.0.16</a>), but
it is built on the same platform as Firefox 3.  We expect to release further
interim as we work towards a major new release of Thunderbird.</p>

<p>Please read the <a href="$releasenotes_30a2_link">release notes</a> for more details.</p>
BODY;

?>
