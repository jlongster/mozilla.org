<?php
    $dir    = (in_array($lang, array('ar', 'fa', 'he'))) ? 'rtl' : 'ltr';

    // get content
    include_once "{$config['file_root']}/{$lang}/thunderbird/3.1/content/details.inc.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=$lang?>" lang="<?=$lang?>" dir="<?=$dir?>">
<head>
    <title>Thunderbird 3.1</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <style type="text/css" media="all">@import "/thunderbird/style/content.css";</style>
    <style type="text/css" media="all">@import "/thunderbird/style/update-3.css";</style>
</head>

<body>

<div id="wrapper">
    <div id="details-header">
        <h1><?=$title?></h1>
        <p><a href="http://www.mozillamessaging.com/<?=$lang?>/thunderbird/" target="_blank"><?=$subtitle?></a></p>

    </div>

    <div id="details-content">

        <ul>
            <li><?=$info1?></li>
            <li><?=$info2?></li>
            <li><?=$info3?></li>
        </ul>

    </div>
</div>

</body>
</html>
