<?php
/**
 * News story template
 *
 * See ../README.txt for info on how to create/update news stories
 */

$story_title = <<<TITLE
Miramar Alpha 1 available for testing
TITLE;

$story_date = '2010-11-23';

$story_snippet = <<<SNIPPET
An early version of our next Thunderbird is ready for testing
SNIPPET;

$faq_link = url('/news/faq/2010-11-23-01');
$alpha1_link = url('/thunderbird/3.3a1/');
$alpha1_downloadlink = url('/thunderbird/early_releases/downloads/');
$releasenotes_33a1_link = url('/thunderbird/3.3a1/releasenotes/');

$story_body = <<<BODY
<p>November 23, 2010</p>

<p>We're happy to announce Miramar Alpha 1, an early version of our next Thunderbird.</p>

<p>Miramar Alpha 1, <a href="$alpha1_downloadlink">available here for download</a>, is for testers,
extension developers, and other friends who are curious to follow the
development of the next release of Thunderbird.</p>

<p><a href="$alpha1_link">Miramar Alpha 1</a> is built on top of the next generation of Mozilla's layout engine, Gecko 2.0 and includes a new Addon Manager and over 190 platform fixes to improve performance and stability.  We expect to release further interim releases as we work towards a major new release of Thunderbird.</p>

<p>Please read the <a href="$releasenotes_33a1_link">release notes</a> for more details.</p>
BODY;

?>




