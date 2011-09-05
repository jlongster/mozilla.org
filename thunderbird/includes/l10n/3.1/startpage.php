<?php

    $dir    = (in_array($lang, array('ar', 'fa', 'he'))) ? 'rtl' : 'ltr';
    $suplk1 = "http://support.mozillamessaging.com/".$lang."/kb/Sending+and+Receiving+Emails";
    $suplk2 = "http://support.mozillamessaging.com/".$lang."/kb/Automatic+Account+Configuration";

    // get content
    ob_start();
    include_once "{$config['file_root']}/{$lang}/thunderbird/3.1/content/start.inc.php";
    $page_content = ob_get_contents();
    ob_clean();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=$lang?>" lang="<?=$lang?>" dir="<?=$dir?>">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title><?=$title?></title>
  <style type="text/css">
body {
  margin: 0;
  padding: 0;
  background: #fff url(/thunderbird/img/thunderbird/start/feature-background-promo.jpg) top center no-repeat;
  color: #333;
  font-family: georgia, serif;
  font-size: small;
  line-height: 1.5;
  min-width: 790px;
}
html {
  min-width: 790px;
}

a:link,
a:visited {
  text-decoration: none;
  color: #c2550a;
}

a:hover,
a:active {
  text-decoration: underline;
  color: #c2550a;
}

a img {
  border: 0;
}

#contents {
  margin: 0 auto;
  width: 780px;
  min-width: 780px;
  padding-left: 20px;
}

#header h1 {
  margin: 0 0 10px 0;
  padding: 50px 0 0 0;
  font-weight: normal;
  font-size: 330%;
  letter-spacing: -1px;
}

#header p {
  max-width: 455px;
  font-size: 135%;
}

p,
ul {
  max-width: 450px;
  font-size: 110%;
}

ul {
  margin-left: -10px;
  padding-left: 0;
}

ul li {
  background-image: url(<?php echo data_url("{$config['file_root']}/img/content/bullet.png",'image/png'); ?>);
  background-position: 0 12px;
  background-repeat: no-repeat;
  list-style-type: none;
  padding: 2px 0 4px 10px;
}

#footer {
  font-size: x-small;
  color: #999;
}

a#lanikai-promo {
    float: right;
    border: none;
    margin-right: 90px;
}

html[dir=rtl] #contents {
  padding:0;
  margin:0;
  padding-right:50%;
  min-width: 50%;
  width: 50%;
}

html[dir=rtl] ul li {
  background-position: 100% 12px;
  padding: 2px 10px 4px 0;
}

  </style>
</head>
<body>
<?php
    echo $page_content;
    unset($page_content);
?>
</body>
</html>

