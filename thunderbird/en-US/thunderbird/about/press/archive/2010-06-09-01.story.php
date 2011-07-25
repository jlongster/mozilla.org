<?php
/**
 * News story template
 *
 * See ../README.txt for info on how to create/update news stories
 */

$story_title = <<<TITLE
Thunderbird 3.1 Release Candidate 2 Available for Download 
TITLE;

$story_date = '2010-06-09';

$story_snippet = <<<SNIPPET
Thunderbird 3.1 Release Candidate 2 is now available for download and testing.
SNIPPET;

$faq_link = url('/news/faq/2010-06-09-01');
$rc1_link = url('/thunderbird/early_releases/downloads/');
$releasenotes_31rc2_link = url('/thunderbird/3.1rc2/releasenotes/');

$story_body = <<<BODY
<p>June 9, 2010</p>

<p>We're happy to announce the second release candidate of <a href="$rc1_link">Thunderbird 3.1</a>, now available for download.</p>

<p>Thunderbird 3.1 Release Candidate 2 is our latest development milestone.  While this release is considered to be stable, it is intended for developers and members of our testing community to use for early evaluation and feedback.  Users of this latest released version of Thunderbird should not expect all of their add-ons to work properly with this milestone.</p>

<p>Thunderbird 3.1 Release Candidate 2 includes several features like the new Quick Filter toolbar, Migration Assistant, and Saved Files Manager that build on the current <a href="http://www.mozillamessaging.com/en-US/thunderbird/">Thunderbird 3</a>. </p>

<p>As always, the Mozilla community would appreciate hearing about any <a href="http://getsatisfaction.com/mozilla_messaging/topics/new">feedback</a> you have about this release, or any <a href="http://developer.mozilla.org/en/docs/Bug_writing_guidelines">bugs you may find</a>.</p>

<p>Please read the <a href="$releasenotes_31rc2_link">release notes</a> for more details.</p>
BODY;

?>


