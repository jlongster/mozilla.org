<?php

    $dir    = (in_array($lang, array('ar', 'fa', 'he'))) ? 'rtl' : 'ltr';

    // get content
    ob_start();
    include_once "{$config['file_root']}/{$lang}/thunderbird/3.1/content/whatsnew.inc.php";
    $page_content = ob_get_contents();
    ob_clean();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=$lang?>" lang="<?=$lang?>" dir="<?=$dir?>">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title><?=$title?></title>
  <style type="text/css">
  body {
    margin: 0;
    padding: 0;
    background: #fff url(<?php echo data_url($config['file_root'].'/img/thunderbird/start/bg-header-small.jpg','image/jpeg'); ?>) repeat-x;
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
    background: url(<?php echo data_url($config['file_root'].'/img/thunderbird/start/main-feature.jpg','image/jpeg'); ?>) top right no-repeat;
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

  h2 {
    font-size:1em;
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
<?php
    echo $page_content;
    unset($page_content);
?>
  </div>
</div>
</body>
</html>
