<?php
/**
 * News story template
 *
 * See ../README.txt for info on how to create/update news stories
 */

$story_title = <<<TITLE
Miramar Alpha 2 Now Available for Testing
TITLE;

$story_date = '2011-01-20';

$story_snippet = <<<SNIPPET
An early version of our next Thunderbird is ready for you to try
SNIPPET;

$faq_link = url('/news/faq/2011-01-20-01');
$alpha2_link = url('/thunderbird/3.3a2/');
$alpha2_downloadlink = url('/thunderbird/early_releases/downloads/');
$releasenotes_33a2_link = url('/thunderbird/3.3a2/releasenotes/');

$story_body = <<<BODY
<p>January 20, 2011</p>

<p>We're happy to announce Miramar Alpha 2, an early version of our next Thunderbird.</p>

<p>Miramar Alpha 2, <a href="$alpha2_downloadlink">available here for download</a>, is for testers,
extension developers, and other friends who are curious to follow the
development of the next release of Thunderbird.</p>

<p><a href="$alpha2_link">Miramar Alpha 2</a> is built on top of the next generation of Mozilla's layout engine, Gecko 2.0 and includes a new Troubleshooting information page, improvements to add-on installation and attachment handling, and numerous other bug fixes.  We expect to release further interim releases as we work towards a major new release of Thunderbird.</p>

<p>Please read the <a href="$releasenotes_33a2_link">release notes</a> for more details.</p>
BODY;

?>