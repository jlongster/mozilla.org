<?php
require_once '../../../../includes/config.inc.php';
require_once '../../../../includes/functions.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Welcome to Thunderbird Beta</title>
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
    background: url(<?php echo data_url('../../../../img/thunderbird/start/main-feature.jpg','image/jpeg'); ?>) top right no-repeat;
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
    <h1>You are now running Thunderbird Beta</h1>
    <p>Thanks for helping us make our next version of Thunderbird the best yet. Give us feedback at our <a href="http://getsatisfaction.com/mozilla_messaging/">Get Satisfaction site.</a></p>
   </div>
   <p><strong>What's New in Thunderbird Beta</strong></p>

   <ul class="spaced">
     <li>New Add-ons Manager: <p><img src="50AddonManager.png" alt="New Add-ons Manager"/></p></li>
     <li>New attachments display with sizes: <p><img src="50AttachmentSizes.png" alt="Revised attachment sizes display"/></p></li>
    <li>Tabs can now be reordered and dragged to different windows</li>
    <li>Revised account creation wizard, offering improved set-up</li>
    <li>New troubleshooting information page to aid supporting and diagnosing problems in Thunderbird</li>
    <li>Plugins can now be loaded in RSS feeds by default</li>
    <li>Various other user interface fixes and improvements</li>
    <li>Support for Mac 32/64 bit Universal builds (Thunderbird will no longer support PowerPC on Mac)</li>
    <li>and numerous other bug fixes</li>
  </ul>
<p>This release is a developer preview of Mozilla Messaging’s next
generation Email client and is being made available for <span
 style="font-weight: bold;">testing purposes only</span>. </p>

<p>We appreciate your support in helping us test and evaluate Thunderbird Beta Please read the <a href="/thunderbird/5.0b1/releasenotes/">release notes</a> before using this preview release.</p>
<p>For additional product information, visit the <a href="/thunderbird/">Thunderbird Home Page</a>.</p>
<p id="footer">© 2011 Mozilla</p>
</div>
</div>
</body>
</html>
