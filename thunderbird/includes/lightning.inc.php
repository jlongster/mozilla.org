<?php

/* Map of user agent string to AMO platform id */
$osmap = array('Linux i686' => '2',
               'Windows;' => '5',
               '(Mac_PowerPC)|(Macintosh)' => '3');


/* Try to detect the platform id */

function lightningPlatform($osmap) {
	$supportedPlatform = null;
	foreach ($osmap as $re => $pid) {
    	if (eregi($re, $_SERVER['HTTP_USER_AGENT'])) {
        	$supportedPlatform = $pid;
        	break;
    	}
	}
	return $supportedPlatform;
}

function lightningURL($supportedPlatform) {
	if ($supportedPlatform) {
    	/* If we detected the user agent correctly, then use it */
    	$lightningUrl = "https://addons.mozilla.org/thunderbird/downloads/latest/2313/platform:$supportedPlatform/addon-2313-latest.xpi?src=external-tb31-whatsnew";
	} else {
    	/* Otherwise open a link to the contrib builds page */
    	$lightningUrl = "http://www.mozilla.org/projects/calendar/releases/lightning1.0b2.html#contributedbuilds";
	}
	return $lightningUrl;
}

?>