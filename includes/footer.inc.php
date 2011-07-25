<?php

require_once 'MozillaOrg/SvnHistoryLink.php';

$extra_footers = empty($extra_footers) ? '' : $extra_footers;

?></div></div><!-- end #main-content and #main -->

<div id="footer-wrap">
    <div id="footer" class="cols">
        <div class="six-col">
	    <a id="logo-footer" href="/"><img src="/images/template/screen/logo_footer.png" alt="Mozilla" /></a>
            <p id="copyright">
                Portions of this content are &copy;1998&ndash;<?=$current_year?> by individual mozilla.org contributors. Content available under a Creative Commons <a href="/foundation/licensing/website-content.html">license</a>.
            </p>
            <p id="copyright-links">
                <a href="/contact/" class="first">Contact Us</a><br />
                <a href="/about/policies/privacy-policy.html">Privacy Policy</a><br />
                <a href="http://www.mozilla.com/en-US/about/legal.html">Legal Notices</a><br />
                <a href="http://www.mozilla.com/en-US/legal/fraud-report/index.html">Report Trademark Abuse</a>
            </p>
        </div>
        <div class="col-span">
            <?php MozillaOrg_SvnHistoryLink::display() ?> — <a href="https://wiki.mozilla.org/Mozilla.org/Editing_Site_with_SVN#Making_Site_Changes">Edit this Page</a>
        </div>
        <div class="five-col">
            <h5 class="footer-nav-title"><strong>About Us</strong></h5>
            <ul class="footer-nav">
                <li><a href="/about/mission.html">Our Mission</a></li>
                <li><a href="/about/forums/">Forums</a></li>
                <li><a href="/about/governance.html">Governance</a></li>
                <li><a href="/about/organizations.html">Organizations</a></li>
                <li><a href="/grants/">Grants</a></li>
                <li><a href="/about/history.html">History</a></li>
                <li><a href="/about/">More&hellip;</a></li>
            </ul>
        </div>
        <div class="five-col">
            <h5 class="footer-nav-title"><strong>Community Map</strong></h5>
            <ul class="footer-nav">
                <li><a href="/community/index.html#applications">Applications</a></li>
                <li><a href="/community/index.html#code">Code</a></li>
                <li><a href="/community/index.html#incubators">Incubators</a></li>
                <li><a href="/community/index.html#community-sites">Community Sites</a></li>
                <li><a href="/community/directory.html">Directory</a></li>
                <li><a href="/community/">More&hellip;</a></li>
            </ul>
        </div>
        <div class="five-col">
            <h5 class="footer-nav-title"><strong>Our Projects</strong></h5>
            <ul class="footer-nav">
                <li><a href="http://www.firefox.com">Firefox</a></li>
                <li><a href="http://www.getthunderbird.com">Thunderbird</a></li>
                <li><a href="http://www.drumbeat.org/projects">Drumbeat</a></li>
                <li><a href="http://www.mozillalabs.com/projects">Mozilla Labs</a></li>
                <li><a href="/support">Support</a></li>
                <li><a href="https://addons.mozilla.org">Add-ons</a></li>
                <li><a href="http://input.mozilla.com">Feedback</a></li>
                <li><a href="/security/announce">Security Advisories</a></li>
                <li><a href="/projects/">More&hellip;</a></li>
            </ul>
        </div>
        <div class="five-col last">
            <h5 class="footer-nav-title"><strong>Get Involved</strong></h5>
            <ul class="footer-nav">
                <li><a href="https://developer.mozilla.org/En/Developer_Guide">Developing</a></li>
                <li><a href="https://developer.mozilla.org/Project:en/How_to_Help">Documentation</a></li>
                <li><a href="https://donate.mozilla.org/page/contribute/openwebfund">Donate</a></li>
                <li><a href="https://wiki.mozilla.org/L10n">Localization</a></li>
                <li><a href="http://contribute.mozilla.org/Marketing">Marketing</a></li>
                <li><a href="http://quality.mozilla.org/">Testing</a></li>
                <li><a href="http://blog.mozilla.com/webdev/get-involved/">Webdev</a></li>
                <li><a href="/contribute">More&hellip;</a></li>
            </ul>
        </div>
    </div><!-- end #footer -->
</div><!-- end #footer-wrap -->

<?php echo $extra_footers; ?>

<!-- START OF SmartSource Data Collector TAG -->
<!-- Copyright (c) 1996-2010 WebTrends Inc.  All rights reserved. -->
<!-- Version: 8.6.2 -->
<!-- Tag Builder Version: 3.0  -->
<!-- Created: 5/10/2010 6:56:34 PM -->
<script src="/script/webtrends.js" type="text/javascript"></script>
<!-- Warning: The two script blocks below must remain inline. Moving them to an external -->
<!-- JavaScript include file can cause serious problems with cross-domain tracking.      -->
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
<div><img alt="DCSIMG" id="DCSIMG" width="1" height="1" src="https://statse.webtrendslive.com/dcsis0ifv10000gg3ag82u4rf_7b1e/njs.gif?dcsuri=/nojavascript&amp;WT.js=No&amp;WT.tv=8.6.2"/></div>
</noscript>
<!-- END OF SmartSource Data Collector TAG -->

</body>
</html>
