<?php
/**
 * News story template
 *
 * See ../README.txt for info on how to create/update news stories
 */

$story_title = <<<TITLE
Thunderbird 3 Release Candidate 2 is now available
TITLE;

$story_date = '2009-12-01';

$story_snippet = <<<SNIPPET
Thunderbird 3 Release Candidate 2 is now available for testing.
SNIPPET;

$faq_link = url('/news/faq/2009-12-01-01');
$rc2_link = url('/thunderbird/early_releases/downloads/');
$releasenotes_30rc2_link = url('/thunderbird/3.0rc2/releasenotes/');

$story_body = <<<BODY
<p>December 1, 2009</p>

<p>We're happy to announce the second release candidate of <a href="$rc2_link">Thunderbird 3</a>, now available for download.</p>

<p>Thunderbird 3 Release Candidate 2 is our latest development milestone.  While this release is considered to be stable, it is intended for developers and members of our testing community to use for early evaluation and feedback.  Users of this latest released version of Thunderbird should not expect all of their add-ons to work properly with this milestone.</p>

<p>Thunderbird 3 Release Candidate 2 includes several features like Better Search, Tabbed email, and message archiving that build on the current <a href="http://www.mozillamessaging.com/en-US/thunderbird/">Thunderbird 2</a>. </p>

<p>Please read the <a href="$releasenotes_30rc2_link">release notes</a> for more details.</p>
BODY;

?>
