<?php

if (isset($include_left_nav_menu) && $include_left_nav_menu) {

    // Set in the global header.inc.php

} else {
    $dynamic_left_menu = '';
}

// Generate the language links to go on the bottom of each page
$lang_list = getLangLinksSelect();

$current_year = date('Y');

$extra_footers = empty($extra_footers) ? '' : $extra_footers;

$latest_thunderbird_version = LATEST_THUNDERBIRD_VERSION;

$dynamic_footer = <<<DYNAMIC_FOOTER

		{$dynamic_left_menu}

</div><!-- end #doc -->
</div><!-- end #wrapper -->

	<!-- start #footer -->
	<div id="footer">
	<div id="footer-contents">
        <div id="footer-right">
    		<form id="lang_form" dir="ltr" method="get" action="/thunderbird/"><div>
    			<label for="flang">{$l10n->get('Other languages:')}</label>
    			{$lang_list}
    			<noscript>
    				<div><input type="submit" id="lang_submit" value="{$l10n->get('Go')}" /></div>
    			</noscript>
    		</div></form>
		</div>

		<ul id="footer-menu">
			<li><a href="/{$lang}/thunderbird/">{$l10n->get('Thunderbird')}</a>
				<ul>
					<li><a href="/{$lang}/thunderbird/features/">{$l10n->get('Features')}</a></li>
					<li><a href="/{$lang}/thunderbird/{$latest_thunderbird_version}/releasenotes/">{$l10n->get('Release Notes')}</a></li>
					<li><a href="/{$lang}/thunderbird/all.html">{$l10n->get('Other Systems and Languages')}</a></li>
				</ul>
			</li>
			<li><a href="https://addons.mozilla.org/thunderbird/" class="external">{$l10n->get('Add-ons')}</a>
				<ul>
					<li><a href="https://addons.mozilla.org/thunderbird/" class="external">{$l10n->get('All Add-ons')}</a></li>
					<li><a href="https://addons.mozilla.org/thunderbird/recommended" class="external">{$l10n->get('Recommended')}</a></li>
					<li><a href="https://addons.mozilla.org/thunderbird/browse/type:1/cat:all?sort=popular" class="external">{$l10n->get('Popular')}</a></li>
					<li><a href="https://addons.mozilla.org/thunderbird/browse/type:2" class="external">{$l10n->get('Themes')}</a></li>
				</ul>
			</li>
			<li><a href="http://support.mozillamessaging.com">{$l10n->get('Support')}</a></li>
			<li><a href="http://www.mozilla.org/community/">{$l10n->get('Community')}</a>
				<ul>
					<li><a href="https://addons.mozilla.org/thunderbird/" class="external">{$l10n->get('Add-ons')}</a></li>
					<li><a href="https://bugzilla.mozilla.org/" class="external">{$l10n->get('Bugzilla')}</a></li>
					<li><a href="http://developer.mozilla.org/" class="external">{$l10n->get('Mozilla Developer Center')}</a></li>
					<li><a href="http://labs.mozilla.com/" class="external">{$l10n->get('Mozilla Labs')}</a></li>
					<li><a href="http://www.mozilla.org/" class="external">{$l10n->get('Mozilla.org')}</a></li>
					<li><a href="http://www.mozillazine.org/" class="external">{$l10n->get('MozillaZine')}</a></li>
					<li><a href="http://planet.mozillamessaging.com/" class="external">{$l10n->get('Planet Mozilla Messaging')}</a></li>
					<li><a href="http://quality.mozilla.org/" class="external">{$l10n->get('Quality')}</a></li>
					<li><a href="http://www.spreadthunderbird.com/" class="external">{$l10n->get('Spread Thunderbird')}</a></li>
				</ul>
			</li>
			<li><a href="/about/">{$l10n->get('About')}</a></li>
		</ul>

		<div id="copyright">
			<p><strong>Copyright &#169; 2005&#8211;{$current_year} Mozilla.</strong> {$l10n->get('All rights reserved.')}</p>
			<p id="footer-links"><a href="/privacy-policy.html">{$l10n->get('Privacy Policy')}</a> &nbsp;|&nbsp; 
			<a href="http://www.mozilla.com/{$lang}/about/legal.html">{$l10n->get('Legal Notices')}</a></p>
		</div>

	</div>
	</div>
	<!-- end #footer -->
	{$extra_footers}
<!-- START OF SmartSource Data Collector TAG -->
<!-- Version: 8.6.2 -->
<!-- Tag Builder Version: 3.0  -->
<script src="/thunderbird/js/webtrends.js" type="text/javascript"></script>
<!-- Warning: The two script blocks below must remain inline. -->
<script type="text/javascript">
//<![CDATA[
var _tag=new WebTrends();
_tag.dcsGetId();
//]]>>
</script>
<script type="text/javascript">
//<![CDATA[
// Add custom parameters here.
//_tag.DCSext.param_name=param_value;
_tag.dcsCollect();
//]]>>
</script>
<noscript>
<div><img alt="DCSIMG" id="DCSIMG" width="1" height="1" src="http://statse.webtrendslive.com/dcsjd66bq10000k73ngwoin8k_7d1l/njs.gif?dcsuri=/nojavascript&amp;WT.js=No&amp;WT.tv=8.6.2"/></div>
</noscript>
<!-- END OF SmartSource Data Collector TAG -->
</body>
</html>
DYNAMIC_FOOTER;

?>
