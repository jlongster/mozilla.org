<?php
/**
 * News story template
 *
 * See ../README.txt for info on how to create/update news stories
 */

$story_title = <<<TITLE
Miramar Alpha 3 Now Available for Testing
TITLE;

$story_date = '2011-03-15';

$story_snippet = <<<SNIPPET
An early version of our next Thunderbird is ready for you to try
SNIPPET;

$faq_link = url('/news/faq/2011-03-15-01');
$alpha3_link = url('/thunderbird/3.3a3/');
$alpha3_downloadlink = url('/thunderbird/early_releases/downloads/');
$releasenotes_33a3_link = url('/thunderbird/3.3a3/releasenotes/');

$story_body = <<<BODY
<p>March 15, 2011</p>

<p>We're happy to announce Miramar Alpha 3, an early version of our next Thunderbird.</p>

<p>Miramar Alpha 3, <a href="$alpha3_downloadlink">available here for download</a>, is for testers,
extension developers, and other friends who are curious to follow the
development of the next release of Thunderbird.</p>

<p><a href="$alpha3_link">Miramar Alpha 3</a> is built on top of the next generation of Mozilla's layout engine, Gecko 2.0 and includes tab reordering with drag and drop into new windows, a revised account creation wizard to improve setup, and numerous other bug fixes.  We expect to release further interim releases as we work towards a major new release of Thunderbird.</p>

<p>Please read the <a href="$releasenotes_33a3_link">release notes</a> for more details.</p>
BODY;

?>