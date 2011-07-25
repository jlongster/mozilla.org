#!/usr/bin/php
<?php

require_once 'MozillaOrg/FeedParser.php';
require_once 'MozillaOrg/FeedParser/CommunityFavIconHandler.php';

$handler = new MozillaOrg_FeedParser_CommunityFavIconHandler();

$parser = new MozillaOrg_FeedParser();
$parser->setFavIconHandler($handler);
$parser->run();

?>
