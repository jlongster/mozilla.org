<?php
/**
 * News story template
 *
 * See ../README.txt for info on how to create/update news stories
 */

$story_title = <<<TITLE
Thunderbird 3.0.4 is Now Available
TITLE;

$story_date = '2010-03-30';

$story_snippet = <<<SNIPPET
Thunderbird 3.0.4 update is now available 
SNIPPET;

$faq_link = url('/news/faq/2009-12-08-01');
$download_link = 'http://www.getthunderbird.com';
$releasenotes_30_link = url('/thunderbird/3.0.4/releasenotes/');

$story_body = <<<BODY
<p>March 30, 2010</p>

<p>
Thunderbird 3.0.4 is now available for Windows, Mac, and Linux for free download from <a href="$download_link">www.GetThunderbird.com</a>.</p>
<p>
As part of the Mozilla Messaging's ongoing security and stability update process, we strongly recommend that all Thunderbird users upgrade to this release. If you already have Thunderbird 3.0, you will receive an automated update notification within 24 to 48 hours. You can also manually fetch this update by selecting "Check for Updates..." from the Help menu.</p>

<p>For a list of changes and more information, please review the Thunderbird 3.0.4 <a href="$releasenotes_30_link">release notes</a>.</p>

BODY;

?>




