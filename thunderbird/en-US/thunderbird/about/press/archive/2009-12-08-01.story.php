<?php
/**
 * News story template
 *
 * See ../README.txt for info on how to create/update news stories
 */

$story_title = <<<TITLE
Mozilla Launches Thunderbird 3 <br>--
Email Innovations That Put You In Charge
TITLE;

$story_date = '2009-12-08';

$story_snippet = <<<SNIPPET
New Release Brings Simple, Fast, Powerful New Features to the Most Customizable Email Application  
SNIPPET;

$faq_link = url('/news/faq/2009-12-08-01');
$download_link = url('/thunderbird/');
$releasenotes_30_link = url('/thunderbird/3.0/releasenotes/');

$story_body = <<<BODY
<p>December 8, 2009</p>

<p>Mozilla Messaging, a wholly owned subsidiary of Mozilla dedicated to developing products that encourage choice, innovation, and opportunity in messaging on the Internet, today announced <a href="$download_link">Thunderbird 3</a>, the latest version of its free and open source email application.</p>
<p>Available in over 49 languages and works with Windows, Mac OS X and Linux, Thunderbird 3 has more than 2,000 improvements including new tabbed email, a radical new search engine, built-in message archiving and smart folders.</p>
<p>To start using Thunderbird 3 visit <a href="$download_link">www.getthunderbird.com</a> to download the application</p>


<h3>Product Highlights</h3>

<p>The new features in Thunderbird 3 help users work faster while providing the advanced flexibility and security they are accustomed to with all versions of Thunderbird. </p>
<p>Key new features in this release include: </p>

<ul><li><strong>Tabbed Email</strong>: Provides the ability view individual emails and folders in tabs, and web pages via add-ons in tabs so users can quickly jump between them, just as one manages web pages in Mozilla's Firefox. Folder tabs are remembered, so Thunderbird starts up pre-configured and personalized to each user.</li>
<li><strong>Filtered Search</strong>: Designed with search in mind, the new search interface in Thunderbird 3 contains filtering and timeline tools to help users quickly and accurately pin-point the exact email by word matches, correspondents or even attachment types at the moment they need it, all based on analysis of the user's own emails.</li>
<li><strong>Message Archive</strong>: Archiving mail moves email from the inbox into the new archive folder system, de-cluttering the inbox while at the same time enabling users to find email months or years from now.</li>
<li><strong>One-click Address Book</strong>: A very quick and easy way to add people to an address book, by simply clicking on the star icon in the messages received from new correspondents.</li>
<li><strong>New Mail Account Setup Wizard</strong>: Getting started with Thunderbird 3 is faster than ever with the new account set-up wizard that requires simple information, like email addresses and passwords to get going instead of a user's IMAP, SMTP, SSL/TLS settings.</li>
<li><strong>Smart Folders</strong>: Combines individual mailboxes to help manage multiple email accounts in one spot. For example, by selecting the Inbox, users can view all the incoming emails from all their different accounts without having to go to each email account separately.</li>
<li><strong>Add-ons Manager</strong>: The new add-ons manager can help users find, download, and install hundreds of add-ons enabling them to customize Thunderbird 3 and add functionality or change the appearance.</li>
<li><strong>Better Integration with Gmail</strong>: Now integrates with international versions of Gmail and Gmail's special folders such as sent and trash.</li>
<li><strong>Better Integration with Windows and Mac OS X</strong>: Updated look and feel, improved import tools, search integration, and address book support for Windows 7, Vista and Mac OS X Snow Leopard.</li>
<li><strong>Gecko 1.9.1 Engine</strong>: The same Web page rendering engine and graphics infrastructure used in Firefox, provides the latest Web Standards support and security enhancements.</li>
<li><strong>Automated Updates</strong>: Thunderbird's update system notifies users when a security update is available and automates the download and installation process to keep users safe. </li>
</ul>

<h3>Mozilla Commentary</h3>

<ul><li>"We have some of the most passionate users on the planet who want a personal and familiar email experience - they choose Thunderbird because it's flexible and they can customize it to be exactly how they want," said David Ascher, CEO of Mozilla Messaging. "And for people who just want their mail to be fast and intuitive, features like the new archiving and search help them spend less time worrying about and managing their email."</li>

<li>"Thunderbird 3 represents more than two years of development from hundreds of developers, security experts, testers and localization and support communities from around the world," added Ascher. "Thunderbird 3 continues its history of giving users the most flexibility and control to get through their email faster and have it simply work the way they want it to plus many of the new features take the best of web mail and bring it to the desktop."</li>
</ul>

<h3>Additional Resources</h3>

<ul><li>Mozilla Thunderbird 3 is available for download at <a href="$download_link">www.getthunderbird.com</a></li>
<li><a href="http://www.spreadthunderbird.com/node/610">Thunderbird 3 FAQ</a></li>
<li><a href="http://www.spreadthunderbird.com/image/tid/14">Thunderbird 3 Images and Screen Shots</a></li>
<li>For more information about Mozilla Thunderbird 3 visit <a href="http://www.mozillamessaging.com">www.mozillamessaging.com</a></li>
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
