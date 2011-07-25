<?php
require_once '../../../../includes/config.inc.php';
require_once '../../../../includes/functions.inc.php';

    $release_fullname = 'Miramar Alpha 3';
    $bug_query = 'https://bugzilla.mozilla.org/buglist.cgi?quicksearch=ALL%20+milestone:%22Thunderbird%203.3a3%22%20+resolution:FIXED%20-status-thunderbird3.1:fixed%20-status-thunderbird3.0:fixed';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>What’s New in Miramar</title>
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
  
  @font-face {
	font-family: 'MetaWebPro-Bold';
	src: local('☺'), url('../../../../img/fonts/metawebpro.woff') format('woff');
	font-style: normal;
  }
  
  a:link    { color: #0a4e96; }
  a:visited { color: #0a4e96; }
  a:hover   { color: #333; }
  a:active  { color: #000; }

  #contents {
    margin: 0;
    padding: 1em 250px 1em 2em;
    background: url(<?php echo data_url('../../../../img/thunderbird/start/main-feature-miramar.jpg','image/jpeg'); ?>) top right no-repeat;
  }

  #header h1 {
    font-family: MetaWebPro-Bold;
    font-size: 27px;
    color: #0A4E96;
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
  <h1>What's New in Miramar!</h1>
<p>Thanks for testing Miramar Alpha 3</p>
</div>
<p><strong>What's New in Miramar Alpha 3</strong></p>
<p>This release is a developer preview of Mozilla Messaging’s next
generation Email client and is being made available for <span
 style="font-weight: bold;">testing purposes only</span>. </p>
<p>Miramar Alpha 3 is built on top of the Gecko 2.0 platform. The main goals of this release is to find out about possible problems caused by the changes in the underlying platform.</p>
<p>Notable change in Miramar Alpha 3 since Miramar Alpha 2:</p>
<ul class="spaced">
  <li>Tabs can now be reordered and dragged to different windows</li>
  <li>Revised account creation wizard, offering improved set-up</li>
  <li>Plugins can now be loaded in RSS feeds by default</li>
  <li>and numerous other bug fixes</li>
</ul>
<p>Notable changes in Miramar when compared to Thunderbird 3.1:</p>
<ul class="spaced">
  <li>New Addons Manager and extension management API (user interface will be changed before final release)</li>
  <li>Attachment sizes now displayed along with attachments</li>
  <li>New troubleshooting information page to aid supporting and diagnosing problems in Thunderbird</li>
  <li>Several user interface fixes for Windows Vista/Windows 7</li>
  <li>Support for Mac 32/64 bit Universal builds (<?=$release_fullname?> will no longer support PowerPC on Mac)</li>
  <li>Over 390 platform fixes to improve performance and stability</li>
</ul>
<p>For a more detailed list of bug fixes, see the <a href="<?=$bug_query?>">the full bug list</a>.</p>
<p>We appreciate your support in helping us test and evaluate
  Miramar Alpha 3.&nbsp; Please read the <a
 href="/thunderbird/3.3a3/releasenotes/">release
    notes</a> before using this preview release.&nbsp; Please leave feedback specific to Miramar Alpha 3 on <a href="http://getsatisfaction.com/mozilla_messaging/topics/miramar_alpha_3_feedback_topic">this thread on our getsatisfaction site</a>. or by filing a bug in bugzilla using these <a
 href="http://developer.mozilla.org/en/Bug_writing_guidelines">instructions</a>.&nbsp; </p>
<p>For additional product information, visit the <a
 href="/thunderbird/">Thunderbird
Home Page</a>.</p>
<p id="footer">© 2011 Mozilla</p>
</div>
</div>
</body>
</html>
