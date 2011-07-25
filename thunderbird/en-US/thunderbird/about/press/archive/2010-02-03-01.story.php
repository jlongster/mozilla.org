<?php
/**
 * News story template
 *
 * See ../README.txt for info on how to create/update news stories
 */

$story_title = <<<TITLE
Lanikai Alpha 1 Now Available for Download
TITLE;

$story_date = '2010-02-03';

$story_snippet = <<<SNIPPET
An early version of our next Thunderbird is ready for testing
SNIPPET;

$faq_link = url('/news/faq/2010-02-03-01');
$alpha1_link = url('/thunderbird/3.1a1/');
$alpha1_downloadlink = url('/thunderbird/early_releases/downloads/');
$releasenotes_31a1_link = url('/thunderbird/3.1a1/releasenotes/');

$story_body = <<<BODY
<p>February 3, 2010</p>

<p>We're happy to announce the first early release
of the next version of Thunderbird.</p>

<p>Lanikai Alpha 1, <a href="$alpha1_downloadlink">available here for download</a>, is for testers,
extension developers, and other people who are curious to follow the
development of the next release of Thunderbird.</p>

<p><a href="$alpha1_link">Lanikai Alpha 1</a> includes initial versions of new features that build on
the current release, 
<a href="/en-US/thunderbird/all.html">Thunderbird 3</a>.  We expect to release further
interim releases as we work towards a major new release of Thunderbird.</p>

<p>Please read the <a href="$releasenotes_31a1_link">release notes</a> for more details.</p>
BODY;

?>
