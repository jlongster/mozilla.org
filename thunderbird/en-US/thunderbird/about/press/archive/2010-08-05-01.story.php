<?php
/**
 * News story template
 *
 * See ../README.txt for info on how to create/update news stories
 */

$story_title = <<<TITLE
Thunderbird 3.1.2 Now Available for Download
TITLE;

$story_date = '2010-08-05';

$story_snippet = <<<SNIPPET
Latest update to Thunderbird 3.1 is now available for download
SNIPPET;

$faq_link = url('/news/faq/2009-12-08-01');
$download_link = 'http://www.getthunderbird.com';
$releasenotes_31_link = url('/thunderbird/3.1.2/releasenotes/');


$story_body = <<<BODY
<p>August 5, 2010</p>

<p>
Thunderbird 3.1.2 is now available for Windows, Mac, and Linux for free download from <a href="$download_link">www.GetThunderbird.com</a>.  This releases make several improvements to Thunderbird's stability and user experience.</p>
<p>
As part of Mozilla Messaging's ongoing security and stability update process, we strongly recommend that all Thunderbird users upgrade to these releases. If you already have Thunderbird 3.1, you will receive an automated update notification within 24 to 48 hours. You can also manually fetch this update by selecting "Check for Updates..." from the Help menu.</p>

<p>For a list of changes and more information, please review the Thunderbird 3.1.2 <a href="$releasenotes_31_link">release notes</a>.</p>

BODY;

?>






