<?php

$feature_langs = array('cs', 'de', 'en-GB', 'es-AR', 'es-ES', 'et', 'eu', 'fr', 'gl', 'is', 'it', 'lt', 'nl', 'nb-NO', 'pl', 'pt-PT', 'rm', 'ru', 'si', 'sl', 'sq', 'zh-TW');
$feature_link = '';
$feature_string = 'Thunderbird';

if (in_array($lang, $feature_langs)) {
    $feature_link = 'features/';
    $feature_string = 'Features';
}

if (isset($include_left_nav_menu) && $include_left_nav_menu) {

    // Set in the global header.inc.php

} else {
    $dynamic_left_menu = '';
}

$current_year       = date('Y');
$extra_footers      = empty($extra_footers) ? '' : $extra_footers;
$extra_footer_links = empty($extra_footer_links) ? '' : $extra_footer_links;

$dynamic_footer = <<<DYNAMIC_FOOTER

        {$dynamic_left_menu}

    </div><!-- end #doc -->
    </div><!-- end #wrapper -->

    <!-- start #footer -->
    <div id="footer">
        <div id="footer-contents">    
            <div class="footer-links">
                <a href="/{$lang}/thunderbird/{$feature_link}">{$l10n->get($feature_string)}</a> &nbsp;|&nbsp;
                <a href="http://addons.mozilla.org/thunderbird">{$l10n->get('Add-Ons')}</a> &nbsp;|&nbsp;
                <a href="http://support.mozillamessaging.com/">{$l10n->get('Support')}</a> &nbsp;|&nbsp;
                <a href="http://www.mozilla.org/about/">{$l10n->get('About')}</a> 
                <div class="footer-privacy">
                    <a href="/about/policies/privacy-policy.html">{$l10n->get('Privacy Policy')}</a> &nbsp;|&nbsp;
                    <a href="http://www.mozilla.com/{$lang}/about/legal.html">{$l10n->get('Legal Notices')}</a>
                </div>
                <div id="copyright">
                    <p><strong>Copyright &#169; 2005&#8211;{$current_year} Mozilla.</strong> {$l10n->get('All rights reserved.')}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- end #footer -->
    <script type="text/javascript">
    /* <![CDATA[ */
        var re_whatsnew = new RegExp('whatsnew');
        if ( !re_whatsnew.test(location.pathname)
                || (new Date()).getSeconds() < 15 ) {
            var s_code=s.t();if(s_code)document.write(s_code);
        }
    /* ]]> */
    </script>
    <!-- end SiteCatalyst code version: H.14 -->

    {$extra_footers}

<!-- START OF SmartSource Data Collector TAG -->
<!-- Version: 8.6.2 -->
<!-- Tag Builder Version: 3.0 -->
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

echo $dynamic_footer;

?>
