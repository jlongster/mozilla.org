<?php
/**
 * News story template
 *
 * See ../README.txt for info on how to create/update news stories
 */

$story_title = <<<TITLE
Thunderbird 3.1.10 Update is Now Available
TITLE;

$story_date = '2011-04-28';

$story_snippet = <<<SNIPPET
New update to Thunderbird 3.1 is available for free download
SNIPPET;

$faq_link = url('/news/faq/2011-04-28-01');
$download_link = 'http://www.getthunderbird.com';
$releasenotes_31_link = url('/thunderbird/3.1.10/releasenotes/');


$story_body = <<<BODY
<p>April 28, 2011</p>

<p>As part of Mozilla Messaging's ongoing security and stability update process, the Thunderbird 3.1.10 update is now available for Windows, Mac, and Linux users for free download from <a href="$download_link">www.GetThunderbird.com</a>. This release makes an several improvements to Thunderbird's performance, stability and security.</p>

<p>We strongly recommend that all Thunderbird users upgrade to this latest release. If you already have Thunderbird 3.1, you will receive an automated update notification within 24 to 48 hours. You can also manually fetch this update by selecting "Check for Updates..." from the Help menu.</p>

<p>For a list of changes and more information, please review the Thunderbird 3.1.10 <a href="$releasenotes_31_link">release notes</a>.</p>

BODY;

?>






