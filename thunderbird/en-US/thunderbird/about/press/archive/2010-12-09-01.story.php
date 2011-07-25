<?php
/**
 * News story template
 *
 * See ../README.txt for info on how to create/update news stories
 */

$story_title = <<<TITLE
Thunderbird 3.1.7 and 3.0.11 Updates Are Here
TITLE;

$story_date = '2010-12-09';

$story_snippet = <<<SNIPPET
Updates to Thunderbird 3.1 and 3.0 are now available for free download
SNIPPET;

$faq_link = url('/news/faq/2010-12-09-01');
$download_link = 'http://www.getthunderbird.com';
$releasenotes_31_link = url('/thunderbird/3.1.7/releasenotes/');
$releasenotes_30_link = url('/thunderbird/3.0.11/releasenotes/');


$story_body = <<<BODY
<p>December 9, 2010</p>

<p>
Thunderbird 3.1.7 and Thunderbird 3.0.11 updates are now available for Windows, Mac, and Linux for free download from <a href="$download_link">www.GetThunderbird.com</a>. These releases fix several problems with large email folders stored on the user's computer as well as several fixes to improve performance, stability and security.</p>
<p>Thunderbird 3.0.11 is the last security and stability update for Thunderbird 3.0.x.  Thunderbird 3.0.x users will be prompted and encouraged to start using Thunderbird 3.1 starting early next year.</p>
<p>
As part of Mozilla Messaging's ongoing security and stability update process, we strongly recommend that all Thunderbird users upgrade to these releases. If you already have Thunderbird 3.1 or 3.0, you will receive an automated update notification within 24 to 48 hours. You can also manually fetch this update by selecting "Check for Updates..." from the Help menu.</p>

<p>For a list of changes and more information, please review the Thunderbird 3.1.7 <a href="$releasenotes_31_link">release notes</a> or the Thunderbird 3.0.11 <a href="$releasenotes_30_link">release notes</a>.</p>

BODY;

?>







