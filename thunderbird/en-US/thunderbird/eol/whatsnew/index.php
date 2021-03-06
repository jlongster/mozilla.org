<?php
require_once '../../../../includes/config.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Welcome to Shredder!</title>
  <style type="text/css">
    body {
      margin: 0;
      padding: 0;
      background: #fff url(/img/thunderbird/start/bg-header-small.jpg) repeat-x;
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
      padding: 2em 2em 1em 2em;
    }

    #header h1 {
      margin: 0;
      padding: 20px 0 0 0;
    }

    #header p {
      font-weight: bold;
      max-width: 500px;
    }

    #footer {
      font-size: x-small;
      color: #999;
    }

    #eol-warning {
      display: block;
      background: #fee5bf url(/img/thunderbird/warning.png) 12px 50% no-repeat;
      border: 1px solid #f9ae64;
      padding: 15px 15px 15px 200px;
      position: relative;
      -moz-border-radius: 10px;
      -moz-box-shadow: 0 2px rgba(0,0,0,0.05), inset 0 -2px rgba(0,0,0,0.05);
      height: auto;
    }
  </style>
</head>
<body>
  <div id="contents">
  <div class="container">
  <div id="header">
  <div id="eol-warning">
    <h1>Warning: Nightly builds are no longer being produced for Thunderbird 3.0.x</h1>
    <p>Thanks for using nightly versions of Thunderbird. However, the Thunderbird 3.0.x series has reached its <a href="https://developer.mozilla.org/devnews/index.php/2010/10/19/sunset-plan-announcement-for-thunderbird-3-0-x/">end of life</a> and will receive no more security or stability updates.</p>
    <p>We recommend you keep up to date with one of the latest Thunderbird releases or nightly builds:</p>
    <ul>
      <li><a href="http://www.getthunderbird.com/">Thunderbird 3.1</a> - the latest stable release of Thunderbird.</li>
      <li><a href="http://ftp.mozilla.org/pub/mozilla.org/thunderbird/nightly/latest-comm-1.9.2/">Thunderbird 3.1 nightlies</a> (<a href="http://ftp.mozilla.org/pub/mozilla.org/thunderbird/nightly/latest-comm-1.9.2-l10n/">localised builds</a>) - based on latest stable release of Thunderbird.</li>
      <li><a href="http://www.mozillamessaging.com/en-US/thunderbird/early_releases/downloads/">Thunderbird 3.3 early-release builds</a>, these are preview releases for an upcoming version of Thunderbird.</li>
      <li><a href="http://ftp.mozilla.org/pub/mozilla.org/thunderbird/nightly/latest-comm-central/">Thunderbird 3.3 nightlies</a> (<a href="http://ftp.mozilla.org/pub/mozilla.org/thunderbird/nightly/latest-comm-central-l10n/">localised builds</a>) - the nightly builds for the next version of Thunderbird.</li>
    </ul>
  </div>
</div>

<p id="footer">&#169; 2010 Mozilla</p>

</div>
</div>
</body>
</html>
