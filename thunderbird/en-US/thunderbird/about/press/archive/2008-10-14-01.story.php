<?php
/**
 * News story template
 *
 * See ../README.txt for info on how to create/update news stories
 */

$story_title = <<<TITLE
Third Alpha of Next version of Thunderbird available
TITLE;

$story_date = '2008-10-14';

$story_snippet = <<<SNIPPET
A new early version of next version of Thunderbird is ready for testing.
SNIPPET;

$faq_link = url('/news/faq/2008-02-19-01');
$alpha3_link = url('/thunderbird/3.0a3/');
$releasenotes_30a3_link = url('/thunderbird/3.0a3/releasenotes/');

$story_body = <<<BODY
<p>October 14, 2008</p>

<p>We're happy to announce the third early release
of the next version of Thunderbird.</p>

<p>This release, called <a href="$alpha3_link">Shredder Alpha 3</a> to emphasize its early
nature and the need for caution, is available for testers,
extension developers, and other people who are curious to follow the
development of the next release of Thunderbird.</p>

<p><a href="$alpha3_link">Shredder Alpha 3</a> includes initial versions of new features that build on
the current release, 
<a href="/en-US/thunderbird/all.html">Thunderbird 2</a>.  We expect to release further
interim releases as we work towards a major new release of Thunderbird.</p>

<p>Please read the <a href="$releasenotes_30a3_link">release notes</a> for more details.</p>
BODY;

?>
