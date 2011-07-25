<?php
/**
 * News story template
 *
 * See ../README.txt for info on how to create/update news stories
 */

$story_title = <<<TITLE
Thunderbird 3.0.3 Now Available
TITLE;

$story_date = '2010-03-01';

$story_snippet = <<<SNIPPET
Latest update to Thunderbird 3 is now available for download
SNIPPET;

$faq_link = url('/news/faq/2009-12-08-01');
$download_link = 'http://www.getthunderbird.com';
$releasenotes_30_link = url('/thunderbird/3.0.3/releasenotes/');

$story_body = <<<BODY
<p>March 1, 2010</p>

<p>
Thunderbird 3.0.3 is now available for Windows, Mac, and Linux for free download from <a href="$download_link">www.GetThunderbird.com</a>.  This release fixes an issue with mail folders for some users who updated to Thunderbird 3.0.2.</p>
<p>
As part of the Mozilla Messaging's ongoing security and stability update process, we strongly recommend that all Thunderbird users upgrade to this release. If you already have Thunderbird 3.0, you will receive an automated update notification within 24 to 48 hours. You can also manually fetch this update by selecting "Check for Updates..." from the Help menu.</p>

<p>For a list of changes and more information, please review the Thunderbird 3.0.3 <a href="$releasenotes_30_link">release notes</a>.</p>

BODY;

?>




