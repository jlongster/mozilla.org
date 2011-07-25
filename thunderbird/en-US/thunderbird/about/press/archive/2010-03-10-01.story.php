<?php
/**
 * News story template
 *
 * See ../README.txt for info on how to create/update news stories
 */

$story_title = <<<TITLE
Lanikai Beta 1 is Here
TITLE;

$story_date = '2010-03-10';

$story_snippet = <<<SNIPPET
An early version of our next Thunderbird is ready for testing
SNIPPET;

$faq_link = url('/news/faq/2010-02-03-01');
$beta1_link = url('/thunderbird/3.1b1/');
$beta1_downloadlink = url('/thunderbird/early_releases/downloads/');
$releasenotes_31b1_link = url('/thunderbird/3.1b1/releasenotes/');

$story_body = <<<BODY
<p>March 10, 2010</p>

<p>We're happy to announce Lanikai Beta 1, an early version of our next Thunderbird.</p>

<p>Lanikai Beta 1, <a href="$beta1_downloadlink">available here for download</a>, is for testers,
extension developers, and other people who are curious to follow the
development of the next release of Thunderbird.</p>

<p><a href="$beta1_link">Lanikai Beta 1</a> includes initial versions of new features that build on
the current release, 
<a href="/en-US/thunderbird/all.html">Thunderbird 3</a>.  We expect to release further
interim releases as we work towards a major new release of Thunderbird.</p>

<p>Please read the <a href="$releasenotes_31b1_link">release notes</a> for more details.</p>
BODY;

?>




