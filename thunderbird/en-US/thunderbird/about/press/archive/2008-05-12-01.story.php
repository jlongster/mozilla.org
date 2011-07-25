<?php
/**
 * News story template
 *
 * See ../README.txt for info on how to create/update news stories
 */

$story_title = <<<TITLE
First Alpha of Next version of Thunderbird available
TITLE;

$story_date = '2008-05-12';

$story_snippet = <<<SNIPPET
Early version of next version of Thunderbird is ready for testing.
SNIPPET;

$faq_link = url('/news/faq/2008-02-19-01');
$early_releases_link = url('/thunderbird/early_releases/');
$releasenotes_30a1_link = url('/thunderbird/3.0a1/releasenotes/');

$story_body = <<<BODY
<p>May 12, 2008</p>

<p>We're happy to announce the release of the first of many early releases
of the next version of Thunderbird.</p>

<p>This release, called Shredder a1 to emphasize its early
nature and the need for caution, is available from the
<a href="$early_releases_link">mozillamessaging.com</a> for testers,
extension developers, and other people who are curious to follow the
development of the next release of Thunderbird.</p>

<p>This release has few functionality changes compared to the current release
of Thunderbird (<a href="/en-US/thunderbird/all.html">2.0.0.14</a>), but
it is built on the same platform as Firefox 3.  We expect to release frequent
early releases as we work towards a major new release of Thunderbird.</p>

<p>Please read the <a href="$releasenotes_30a1_link">release notes</a> for more details.</p>
BODY;

?>
