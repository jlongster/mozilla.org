<?php
    // This crap is here to work around requiring firefoxDetails.class.php because it causes a collision if our latest beta version is 
    define('LATEST_FIREFOX_VERSION', '0.0');
    define('LATEST_FIREFOX_RELEASED_VERSION', '0.0');
    define('LATEST_FIREFOX_DEVEL_VERSION', '0.0');
    define('LATEST_FIREFOX_RELEASED_DEVEL_VERSION', '0.0');
    define('LATEST_FIREFOX_OLDER_VERSION', '0.0');
    define('FIREFOX_AURORA', '0.0');
    
    require_once dirname(__FILE__).'/product-details/thunderbirdBuildDetails.php';

    /**
     * Holds data related to the current version of Thunderbird.
     *
     * Q: We're releasing a new version of Thunderbird - what should I do?
     * A:
     *    1) Obtain a copy of:
     *    http://hg.mozilla.org/users/bugzilla_standard8.plus.com/drivertools/file/default/website/generateThunderbirdDetails.py
     *    2) Run it, providing the new version as an argument, and a list of any
     *       beta locales.
     *    3) Replace the thunderbirdBuildDetails.class.php file with the generated file
     *    4) Update history/thunderbirdHistory.class.php
     */
    class thunderbirdDetails extends thunderbirdBuildDetails {

        /**
         * Array: primary_builds is defined in thunderbirdBuildDetails
         *
         * Array holding information about current available builds.  Filesize
         * is in megabytes. If you add a new language here, make sure it exists in
         * localeDetails::languages too.
         *
         *  If you don't want a download button to appear for a certain platform, just don't put that platform in the array
         *
         *  If you want "Not Yet Available" to appear for the locale, set the version to null.  If getDownloadBlockForLocale()
         *  is called, it will offer the most recent version that actually has a value.
         *
         * @var array
         */

        /**
         * Array: beta_builds is defined in thunderbirdBuildDetails
         *
         * Array holding information about currently available beta builds
         *
         * @var array
         */

        /**
         * Constructor.
         */
        function thunderbirdDetails() {
            parent::thunderbirdBuildDetails();
            $this->download_base_url_transition = '/thunderbird/download/';
        }

        /**
         * Returns an HTML block with links for a certain locale
         *
         * @param string locale
         * @param array options no functionality; for compatibility with firefoxDetails
         * @return string HTML block
         */
        function getAncillaryLinksForLocale($locale, $options=array()) {
            $_current_version = $this->getNewestVersionForLocale($locale);

            $_release_notes               = ___('Release Notes');
            $_other_systems_and_languages = ___('Other Systems and Languages');

            $_return = <<<HTML_RETURN
            <span class="download-other">
                <a class="ancillaryLink" href="http://www.mozilla.org/{$locale}/thunderbird/{$_current_version}/releasenotes/">{$_release_notes}</a> -
                <a class="ancillaryLink" href="http://www.mozilla.org/{$locale}/thunderbird/all.html">{$_other_systems_and_languages}</a>
            </span>
HTML_RETURN;

            return $_return;
        }

        /**
         * Overload parent function.  See parent for details.
         *
         */
        function getDownloadBlockForLocale($locale, $options=array()) {
			global $config;
            $options['product'] = array_key_exists('product', $options) ?
            $options['product'] : 'thunderbird';
            # Used on the sidebar only
            if (!isset($options['download_title'])) {
                $options['download_title'] = ___('Free Download');
            }

			if (array_key_exists('tb_funnelcake', $config) && !empty($config['tb_funnelcake']['suffix']) && in_array($locale, $config['tb_funnelcake']['lang'])) {
		        $options['tweaks'] = array('/thunderbird-'.LATEST_THUNDERBIRD_VERSION.'([^"]*)' . $locale . '/' => 'thunderbird-'.LATEST_THUNDERBIRD_VERSION.$config['tb_funnelcake']['suffix'].'$1' . $locale);
		    }
            return parent::getDownloadBlockForLocale($locale, $options);
        }

        /**
         * Convenience function to return a <table> of Thunderbird primary builds
         *
         * @param array options (more detail in getDownloadBlockForLocale())
         * @return string HTML block
         */
        function getDownloadTableForPrimaryBuilds($options=array()) {

            $options['product']        = array_key_exists('product', $options) ? $options['product'] : 'thunderbird';
            $options['latest_version'] = LATEST_THUNDERBIRD_VERSION;
			global $config;
			
			if (array_key_exists('tb_funnelcake', $config) && !empty($config['tb_funnelcake']['suffix'])) {
		        foreach ($config['tb_funnelcake']['lang'] as $lang) {
		        	$key = '/thunderbird-'.LATEST_THUNDERBIRD_VERSION.'([^"]*)' . $lang . '/';
		       		$options['tweaks'][$key] = 'thunderbird-'.LATEST_THUNDERBIRD_VERSION.$config['tb_funnelcake']['suffix'].'$1' . $lang;
		        }
		    }
            return $this->tweakString($this->_getDownloadTableFromBuildArray($this->primary_builds, $options), $options);
        }

        /**
         * Convenience function to return a <table> of Thunderbird beta builds
         *
         * @param array options (more detail in getDownloadBlockForLocale())
         * @return string HTML block
         */
        function getDownloadTableForBetaBuilds($options=array()) {

            $options['product']        = array_key_exists('product', $options) ? $options['product'] : 'thunderbird';
            $options['latest_version'] = LATEST_THUNDERBIRD_VERSION;

            return $this->tweakString($this->_getDownloadTableFromBuildArray($this->beta_builds, $options), $options);
        }

        /**
         * Return a <table> with the links to the older versions of all locales with
         * primary builds.  We keep links to a single previous version.
         *
         * @return string HTML block
         */
        function getDownloadTableForOlderPrimaryBuilds($options=array()) {

            $options['product']        = array_key_exists('product', $options) ? $options['product'] : 'thunderbird';
            $options['latest_version']  = LATEST_THUNDERBIRD_VERSION;
            $options['product_version'] = 'oldest';

            return $this->tweakString($this->_getDownloadTableFromBuildArray($this->primary_builds, $options), $options);
        }

        /**
         * Return a <table> with the links to the older versions of all locales with
         * beta builds.  We keep links to a single previous version.
         *
         * @return string HTML block
         */
        function getDownloadTableForOlderBetaBuilds($options=array()) {

            $options['product']        = array_key_exists('product', $options) ? $options['product'] : 'thunderbird';
            $options['latest_version']  = LATEST_THUNDERBIRD_VERSION;
            $options['product_version'] = 'oldest';

            return $this->tweakString($this->_getDownloadTableFromBuildArray($this->beta_builds, $options), $options);
        }

        /**
         * TEMPORARY CODE
         *          20070827_TEMP
         * Overload parent function.  See parent for details.
         *
         */
        function getNoScriptBlockForLocale($locale, $options=array()) {

            $options['product'] = array_key_exists('product', $options) ? $options['product'] : 'thunderbird';

            return parent::getNoScriptBlockForLocale($locale, $options);
        }

    }
?>
