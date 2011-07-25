<?php
/**
 * News story template
 *
 * See ../README.txt for info on how to create/update news stories
 */

$story_title = <<<TITLE
Thunderbird 3.0.2 Now Available
TITLE;

$story_date = '2010-02-25';

$story_snippet = <<<SNIPPET
Thunderbird 3.0.2 is available for Download
SNIPPET;

$faq_link = url('/news/faq/2009-12-08-01');
$download_link = 'http://www.getthunderbird.com';
$releasenotes_30_link = url('/thunderbird/3.0.2/releasenotes/');

$story_body = <<<BODY
<p>February 25, 2010</p>

<p>As part of the Mozilla Messaging's ongoing security and stability process, Thunderbird 3.0.2 is now available for Windows, Mac, and Linux users as a free download from <a href="$download_link">www.GetThunderbird.com</a>.</p>
<p>
We strongly recommend that all Thunderbird 3.0 users upgrade to this latest release. If you already have Thunderbird 3.0, you will receive an automated update notification within 24 to 48 hours. This update can also be applied manually by selecting "Check for Updates..." from the Help menu.</p>
<p>
For a list of changes and more information, please see the Thunderbird 3.0.2 <a href="$releasenotes_30_link">release notes</a>.
</p>
BODY;

?>

