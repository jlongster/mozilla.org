<?php
/**
 * News story template
 *
 * See ../README.txt for info on how to create/update news stories
 */

$story_title = <<<TITLE
Thunderbird 3.1.4 and 3.0.8 Updates Are Now Available
TITLE;

$story_date = '2010-09-16';

$story_snippet = <<<SNIPPET
Updates to Thunderbird 3.1 and 3.0 are now available for free download
SNIPPET;

$faq_link = url('/news/faq/2010-09-16-01');
$download_link = 'http://www.getthunderbird.com';
$releasenotes_31_link = url('/thunderbird/3.1.4/releasenotes/');
$releasenotes_30_link = url('/thunderbird/3.0.8/releasenotes/');


$story_body = <<<BODY
<p>September 16, 2010</p>

<p>
Thunderbird 3.1.4 and Thunderbird 3.0.8 updates are now available for Windows, Mac, and Linux for free download from <a href="$download_link">www.GetThunderbird.com</a>.  These releases fix a stability problems affecting a limited number of users.</p>
<p>
As part of Mozilla Messaging's ongoing security and stability update process, we strongly recommend that all Thunderbird users upgrade to these releases. If you already have Thunderbird 3.1 or 3.0, you will receive an automated update notification within 24 to 48 hours. You can also manually fetch this update by selecting "Check for Updates..." from the Help menu.</p>

<p>For a list of changes and more information, please review the Thunderbird 3.1.4 <a href="$releasenotes_31_link">release notes</a> or the Thunderbird 3.0.8 <a href="$releasenotes_30_link">release notes</a>.</p>

BODY;

?>






