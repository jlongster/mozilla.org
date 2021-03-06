<?php
require_once '../../../../includes/config.inc.php';
require_once '../../../../includes/functions.inc.php';

$release_version = '3.0.11';

// release_build_no only needs setting on a second or later beta candidate.
// Set it to something like '(Build 2)'.
$release_build_no = '';
$release_date = 'November 29th, 2010';

// tb_fixed_version is '.n-fixed' where 'n' is the minor number of the
// release
$tb_fixed_version = '.11-fixed';

// gecko_fixed_version is '.n-fixed' where 'n' is the minor number of the
// release
$gecko_fixed_version = '.16-fixed';

$release_fullname = 'Thunderbird&nbsp;'.$release_version;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Thunderbird Updated</title>
  <style type="text/css">
  body {
    margin: 0;
    padding: 0;
    background: #fff url(<?php echo data_url('../../../../img/thunderbird/start/bg-header-small.jpg','image/jpeg'); ?>) repeat-x;
    color: #3C475B;
    font-family: "segoe ui", tahoma, sans-serif;
    font-size: small;
    line-height: 1.5;
    min-width: 500px;
  }

  a:link    { color: #0a4e96; }
  a:visited { color: #0a4e96; }
  a:hover   { color: #333; }
  a:active  { color: #000; }

  #contents {
    margin: 0;
    padding: 1em 250px 1em 2em;
    background: url(<?php echo data_url('../../../../img/thunderbird/start/main-feature.jpg','image/jpeg'); ?>) top right no-repeat;
  }

  #header h1 {
    margin: 0;
    padding: 20px 0 0 0;
  }

  #header p {
    font-weight: bold;
    margin: 0;
    padding: 0 0 40px 0;
    max-width: 500px;
  }

  #footer {
    font-size: x-small;
    color: #999;
  }
  </style>
</head>
<body>
  <div id="contents">
  <div class="container">
  <div id="header">
  <h1>Thanks for beta testing Thunderbird 3</h1>
  <p>If you notice any problems while you use this update, please let us
  know by either using
  <a href="http://getsatisfaction.com/mozilla_messaging/">this feedback form</a>
  or by <a href="https://bugzilla.mozilla.org/">filing a bug in Bugzilla</a>.</p
  ></div>
  <p><?=$release_fullname?> Beta was released on <?=$release_date?>.</p>
<p><strong>What's New in this Beta version of Thunderbird 3</strong></p>
<p>There were several fixes to improve stability and security of Thunderbird 3. There were also fixes to the user interface. Please see the <a href="https://bugzilla.mozilla.org/buglist.cgi?field0-0-0=cf_status_thunderbird30;type0-0-1=equals;field0-0-1=cf_status_191;query_format=advanced;value0-0-1=<?=$gecko_fixed_version?>;type0-0-0=equals;value0-0-0=<?=$tb_fixed_version?>">complete list of changes</a> in this version or view the <a href="../releasenotes">release notes</a> for more information.</p>
<p><strong>What's New in Thunderbird 3</strong></p>
<p>We hope you enjoy the new features in Thunderbird. We have new search tools, tabbed email, message archiving, and hundreds of add-ons to make Thunderbird 3 all yours. </p>
<p><strong>Better Search with New Search Tools</strong></p>
<p>Type in your search term in the Global Search Bar and we will open your search results in a new tab. You can pinpoint what you're looking for with Thunderbird's new filtering and timeline tools. </p>
<p><strong>Tabbed Email</strong></p>
<p>If you like Firefox’s tabbed browsing, you’re going to love tabbed email. Double-click or hit enter on a mail message to open messages in a new tab window. You can right-click on messages or folders to open them in a tab background.</p>
<p><strong>Message Archiving</strong></p>
<p>Clicking the Archive button or  the ‘A’ key will archive your email. Archiving mail moves email from your inbox into the new archive folder system.</p>
<p><strong>More New Features to Explore</strong>:</p>
<ul><li>Smart Folders</li>
  <li>Activity Manager</li>
  <li>One-click Address Book</li>
  <li>Attachment Reminder</li>
  <li>New Add-ons Manager and hundreds of Add-ons to try</li>
</ul>
<p>For additional product information, visit the <a
 href="/thunderbird/">Thunderbird
Home Page</a>.</p>
<p id="footer">© 2010 Mozilla</p>
</div>
</div>
</body>
</html>
