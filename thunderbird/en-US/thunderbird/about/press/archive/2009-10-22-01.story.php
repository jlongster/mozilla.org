<?php
/**
 * News story template
 *
 * See ../README.txt for info on how to create/update news stories
 */

$story_title = <<<TITLE
Introducing Raindrop
TITLE;

$story_date = '2009-10-22';

$story_snippet = <<<SNIPPET
Learn more about our open experiment in messaging on the web.
SNIPPET;

$faq_link = url('/news/faq/2009-09-22-01');
$beta4_link = url('/thunderbird/early_releases/downloads/');
$releasenotes_30b3_link = url('/thunderbird/3.0b4/releasenotes/');

$story_body = <<<BODY
<p>October 22, 2009</p>

<p><a href="http://labs.mozilla.com/raindrop">Raindrop</a> is a new exploration, hosted at Mozilla Labs, to explore new ways to use open Web technologies to create useful, compelling messaging experiences.</p>

<p>Raindrop's mission: make it enjoyable to participate in conversations from people you care about, whether the conversations are in email, on twitter, a friend's blog or as part of a social networking site.</p>

<p>Raindrop uses a mini web server to fetch your conversations from different sources (mail, twitter, RSS feeds), intelligently pulls out the important parts, and allows you to interact with them using your favorite modern web browser (Firefox, Safari or Chrome).</p>

<p>Raindrop comes with a built-in experience that bubbles up what conversations are important to you. You can participate in the experience by writing extensions that use standard open Web technologies like HTML, JavaScript and CSS. Or, use the lower level APIs to make your own experience. You have control over your conversations and how you want to play with them.</p>

<p>As with all explorations hosted by Labs, Raindrop is an open source project and everyone is welcome to participate in its design, development and testing.</p>

<p>Learn more at <a href="http://labs.mozilla.com/raindrop">labs.mozilla.com/raindrop</a> or connect with us using our <a href="https://wiki.mozilla.org/Raindrop/Community">community page.

BODY;

?>
