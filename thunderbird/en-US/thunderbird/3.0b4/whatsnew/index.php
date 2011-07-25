<?php
require_once '../../../../includes/config.inc.php';
require_once '../../../../includes/functions.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>What’s New in Thunderbird</title>
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
  <h1><img style="width: 340px; height: 25px;"
 src="<?php echo data_url('../../../../img/thunderbird/start/whats-new.png','image/png'); ?>"
 alt="What’s New in Thunderbird" /></h1>
<p>Thanks for trying Thunderbird 3 Beta 4.</p>
</div>
<p>This release is a developer preview of Mozilla Messaging’s next
generation Email client and is being made available for <span
 style="font-weight: bold;">testing purposes only</span>. </p>
<p><strong>Redesigned Interface</strong></p>
<p>The Mail Toolbar is streamlined to include the new search bar. The new search bar makes it easier to search your email, and it now auto completes against your address book. Buttons can be added back to the Mail Toolbar by right-clicking and using the customized toolbar feature.</p>
<p><strong>Smart Folders</strong></p>
<p>Smart Folders gives you one inbox and other global folders to manage your email across multiple accounts. To switch back to viewing folders by Account, use the right and left arrow icons to go back to 'All Folders'.</p>
<p><strong>Improvements for IMAP Users</strong></p>
<p>For IMAP users, Thunderbird is downloading your emails and storing them on your computer to improve performance. You may experience a delay while Thunderbird downloads your emails for the first time. Your IMAP folders are also set to synchronize so you can access your email when you are not connected to the Internet and also improves searching your email. You can turn this feature off in the Account Settings, 'Synchronize &amp; Storage'.</p>
<p><strong>What’s New in this Release:</strong></p>
  <ul><li>New Search with advanced filtering tools</li>
<li>Redesigned Mail Toolbar and Global Search field</li>
<li>New Mail Account Setup Wizard</li>
<li><a href="https://developer.mozilla.org/En/Thunderbird_3_for_developers">Improvements for developers</a></li>
<li><a href="http://www.rumblingedge.com/2009/09/23/thunderbird-3-beta-4-released/">complete list of bugs fixed</a></li>
</ul>
<p>We appreciate your support in helping us test and evaluate
  Thunderbird 3 Beta 4.&nbsp; Please read the <a
 href="/thunderbird/3.0b4/releasenotes/">release
    notes</a> before using this preview release.&nbsp; If you have
  feedback, please send it to us by visiting our <a
 href="news://news.mozilla.org/mozilla.feedback.thunderbird.prerelease">newsgroup</a>
  or by filing a bug in bugzilla using these <a
 href="http://developer.mozilla.org/en/Bug_writing_guidelines">instructions</a>.&nbsp;</p>
<p>For the latest product information, visit the <a
 href="/thunderbird/">Thunderbird
Home Page</a>.</p>
<p id="footer">© 2009 Mozilla</p>
</div>
</div>
</body>
</html>
