<?php
/**
 * News story template
 *
 * See ../README.txt for info on how to create/update news stories
 */

$story_title = <<<TITLE
Mozilla Delivers Thunderbird 3.1 Upgrade to Millions of Users 
TITLE;

$story_date = '2010-06-24';

$story_snippet = <<<SNIPPET
Updated Release Includes Faster Search and Indexing, New Migration Assistant and New Saved Files Manager  
SNIPPET;

$faq_link = url('/news/faq/2010-06-24-01');
$download_link = 'http://www.getthunderbird.com';
$releasenotes_31_link = url('/thunderbird/3.1/releasenotes/');

$story_body = <<<BODY
<p>June 24, 2010</p>


<p>Mozilla Messaging, a wholly owned subsidiary of Mozilla dedicated to developing products that encourage choice, innovation, and opportunity in messaging on the Internet, today announced the availability of Thunderbird 3.1, the latest version of its free and open source email application.</p>
<p>Available in over 46 languages and works with Windows, Mac OS X and Linux, Thunderbird 3.1 includes several new features focused on faster search, a better upgrade experience, and simpler enterprise deployment.</p>
<p>To start using Thunderbird 3.1 visit <a href="$download_link">www.getthunderbird.com</a> to download the application</p>


<h3>Highlights of Thunderbird 3.1</h3>


<p>Key new features in this release include: </p>

<ul><li><strong>Faster Search Results:</strong>Message indexing is faster and provides users with faster search results.</li>
<li><strong>Quick Filter Toolbar:</strong> Makes it faster and easier to search and sort through what's in a user's inbox by letting users filter against search terms, tags, starred messages, address book contacts, new emails, and attachments.</li>
<li><strong>Migration Assistant:</strong> This release includes a completely new and easier way to migrate from Thunderbird 2. The new Migration Assistant gives Thunderbird 2 users a way to choose the new features in Thunderbird 3.1 or to keep their current features and settings.</li>
<li><strong>Saved Files Manager:</strong> Finding a downloaded item is a cinch with the new Saved Files Manager which displays all the files users downloaded from their email to their computer.</li>
</ul>


<h3>Additional Resources</h3>

<ul><li>Mozilla Thunderbird 3.1 is available for download at <a href="$download_link">www.getthunderbird.com</a></li>
<li>For more information about Mozilla Thunderbird 3.1 visit <a href="http://www.mozillamessaging.com">www.mozillamessaging.com</a></li>
<li>For information about enterprise deployment of Mozilla Thunderbird 3.1 visit <a href="https://developer.mozilla.org/en/Thunderbird/Deploying_Thunderbird_in_the_Enterprise">developer.mozilla.org/Thunderbird/Deploying_Thunderbird_in_the_Enterprise</a></li>
</ul>


<h3>About Mozilla and Mozilla Messaging</h3>

<p>Mozilla is a global community of people creating a better Internet. As a wholly owned subsidiary of Mozilla, Mozilla Messaging organizes the development and marketing of email and messaging products encouraging choice, innovation, and opportunity in messaging on the Internet.  Everything we create is a public asset available for others to use, adapt and improve. For more information, visit <a href="http://www.mozillamessaging.com">www.mozillamessaging.com</a>.</p>

<h3>
Press Contact</h3>

<p>
Tracy Sjogreen<br>
Nectar Communications<br>
tracy@nectarpr.com<br>
415-868-5595<br>
</p>

BODY;

?>
