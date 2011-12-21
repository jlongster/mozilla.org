<?php
/**
 * This file is separate from config.inc.php because we want these variables to be
 * easily updatable from SVN.
 *
 * These values should reflect the Mozilla.com file.
 * Last revision: r17671
 */

/**
 * A mapping between the short name for the language and the full name of the language
 * (encoded to print in html).  Locales don't need to be in this list if they are
 * being remapped.
 */
$native_languages = array(
    'af'        => 'Afrikaans',
    'ar'        => '&#1593;&#1585;&#1576;&#1610;',
    'as'        => '&#2437;&#2488;&#2478;&#2496;&#2479;&#2492;&#2494;',
    'ast'       => 'Asturianu',
    'bg'        => '&#1041;&#1098;&#1083;&#1075;&#1072;&#1088;&#1089;&#1082;&#1080;',
    'be'        => 'Беларуская',
    'bn-IN'     => '&#2476;&#2494;&#2434;&#2482;&#2494;',
    'ca'        => 'Catal&#224;',
    'br'        => 'Breton',
    'cs'        => '&#268;e&#353;tina',
    'cy'        => 'Cymraeg',
    'da'        => 'Dansk',
    'de'        => 'Deutsch',
    'el'        => '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;',
    'en-GB'     => 'English (British)',
    'en-US'     => 'English (US)',
    'es-AR'     => 'Espa&#241;ol (Argentina)',
    'es-CL'     => 'Espa&#241;ol (Chile)',
    'es-ES'     => 'Espa&#241;ol (Espa&#241;a)',
    'es-MX'     => 'Espa&#241;ol (México)',
    'eo'        => 'Esperanto',
    'et'        => 'Eesti keel',
    'eu'        => 'Euskara',
    'fa'        => '&#1601;&#1575;&#1585;&#1587;&#1740;',
    'fi'        => 'Suomi',
    'fr'        => 'Fran&#231;ais',
    'fy-NL'     => 'Frysk',
    'ga-IE'     => 'Gaeilge',
    'gd'        => 'Gàidhlig',
    'gl'        => 'Galego',
    'gu-IN'     => '&#2711;&#2753;&#2716;&#2736;&#2750;&#2724;&#2752;',
    'he'        => '&#1506;&#1489;&#1512;&#1497;&#1514;',
    'hi-IN'     => '&#2361;&#2367;&#2344;&#2381;&#2342;&#2368; (&#2349;&#2366;&#2352;&#2340;)',
    'hr'        => 'Hrvatski',
    'hu'        => 'Magyar',
    'hy-AM'     => '&#1344;&#1377;&#1397;&#1381;&#1408;&#1381;&#1398;',
    'id'        => 'Bahasa Indonesia',
    'is'        => '&#205;slenska',
    'it'        => 'Italiano',
    'ja'        => '&#26085;&#26412;&#35486;',
    'ka'        => '&#4325;&#4304;&#4320;&#4311;&#4323;&#4314;&#4312;&#32;&#4308;&#4316;&#4304;',
    'kk'        => 'Қазақ',
    'kn'        => '&#57522;&#38368;&#45736;&#57523;&#36320;&#45736;&#57522;',
    'ko'        => '&#54620;&#44397;&#50612;',
    'ku'        => 'Kurd&#238;',
    'lt'        => 'Lietuvi&#371;',
    'lv'        => 'Latvie&#353;u',
    'mk'        => '&#1052;&#1072;&#1082;&#1077;&#1076;&#1086;&#1085;&#1089;&#1082;&#1080;',
    'ml'        => '&#3374;&#3378;&#3375;&#3390;&#3379;&#3330;',
    'mn'        => '&#1052;&#1086;&#1085;&#1075;&#1086;&#1083;',
    'mr'        => '&#2350;&#2352;&#2366;&#2336;&#2368;',
    'nb-NO'     => 'Norsk bokm&#229;l',
    'ne-NP'     => '&#2344;&#2375;&#2346;&#2366;&#2354;&#2368;',
    'nl'        => 'Nederlands',
    'nn-NO'     => 'Norsk nynorsk',
    'oc'        => 'occitan (lengadocian)',
    'or'        => 'ଓଡ଼ିଆ',
    'pa-IN'     => '&#2602;&#2672;&#2588;&#2622;&#2604;&#2624;',
    'pl'        => 'Polski',
    'pt-BR'     => 'Portugu&#234;s (do Brasil)',
    'pt-PT'     => 'Portugu&#234;s (Europeu)',
    'rm'        => 'Rumantsch',
    'ro'        => 'Rom&#226;n&#259;',
    'ru'        => '&#1056;&#1091;&#1089;&#1089;&#1082;&#1080;&#1081;',
    'rw'        => 'Ikinyarwanda',
    'si'        => '&#3523;&#3538;&#3458;&#3524;&#3517;',
    'sk'        => 'Sloven&#269;ina',
    'sl'        => 'Slovensko',
    'sq'        => 'Shqip',
    'sr'        => '&#1057;&#1088;&#1087;&#1089;&#1082;&#1080;',
    'sv-SE'     => 'Svenska',
    'ta'        => '&#2980;&#2990;&#3007;&#2996;&#3021;',
    'ta-LK'     => 'Tamil (Sri Lanka)',
    'te'        => '&#57520;&#42208;&#45446;&#57520;&#45792;&#45441;&#57520;&#38880;&#45441;',
    'th'        => '&#3616;&#3634;&#3625;&#3634;&#3652;&#3607;&#3618;',
    'tr'        => 'T&#252;rk&#231;e',
    'uk'        => '&#1059;&#1082;&#1088;&#1072;&#1111;&#1085;&#1089;&#1100;&#1082;&#1072;',
    'vi'        => 'Tiếng Việt',
    'zh-CN'     => '&#20013;&#25991; (&#31616;&#20307;)',
    'zh-TW'     => '&#27491;&#39636;&#20013;&#25991; (&#32321;&#39636;)'
);


/**
 * All the languages we support.  They won't show up on the site unless they are in
 * this array.  This array needs to have all languages, even if they are being
 * remapped.
 */
$full_languages = array(
    'af',
    'ar',
    'as',
    'ast',
    'be',
    'bg',
  'br',
    'bn-BD',
    'bn-IN',
    'ca',
    'cs',
    'cy',
    'da',
    'de',
    'el',
    'en', // Remap to en-US
    'en-GB',
    'en-US',
    'eo',
    'es', // Remap to es-ES
    'es-AR',
    'es-ES',
    'et',
    'eu',
    'fa',
    'fi',
    'fr',
    'fy-NL',
    'ga-IE',
    'gd',
    'gl',
    'gu-IN',
    'he',
    'hi-IN',
    'hu',
    'hy-AM',
    'id',
    'is',
    'it',
    'ja',
    'ja-JP-mac', // Remap to ja
    'ka',
    'kn',
    'ko',
    'ku',
    'lt',
    'lv',
    'mk',
    'ml',
    'mn',
    'mr',
    'nb-NO',
    'ne-NP',
    'nl',
    'nn-NO',
    'no', // Remap to nb-NO
    'oc',
    'pa-IN',
    'pl',
    'pt', // Remap to pt-PT
    'pt-BR',
    'pt-PT',
    'rm',
    'ro',
    'ru',
    'rw',
    'si',
    'sk',
    'sl',
    'sq',
    'sr',
    'sv', // Remap to sv-SE
    'sv-SE',
    'ta',
    'ta-LK',
    'te',
    'th',
    'tr',
    'uk',
    'vi',
    'zh-CN',
    'zh-TW'
);

/**
 * If we support a locale but want to redirect it to another, add it to this array.
 * Format:
 *      lower(requested_language) => mapped_language
 */
$lang_remap = array(
    'en'        => 'en-US',
    'es'        => 'es-ES',
    'ja-jp-mac' => 'ja',
    'no'        => 'nb-NO',
    'pt'        => 'pt-PT',
    'sv'        => 'sv-SE'

);

/*** TEMPORARY CODE ***/
/**
 * A mapping between the short name for the language and the URL for where it's files
 * are.  This is a temporary measure, while we localize pages and move them from
 * external servers to mozilla.com.  As languages are migrated to mozilla.com, change
 * them in this array to point to mozilla.com.  When all the locales in this list
 * point to mozilla.com delete the array and remove the corresponding section marked
 * "TEMPORARY CODE" in prefetch.php.
 */
$language_url_map = array(
    'af'        => 'http://www.mozillamessaging.com/af/',
    'sq'        => 'http://www.mozillamessaging.com/sq/',
    'ar'        => 'http://www.mozillamessaging.com/ar/',
    'eu'        => 'http://www.mozillamessaging.com/eu/',
    'be'        => 'http://www.mozillamessaging.com/be/',
    'bn-BD'     => 'http://www.mozillamessaging.com/bn-BD/',
    'bg'        => 'http://www.mozillamessaging.com/bg/',
    'ca'        => 'http://www.mozillamessaging.com/ca/',
    'zh-CN'     => 'http://www.mozillamessaging.com/zh-CN/',
    'zh-TW'     => 'http://www.mozillamessaging.com/zh-TW/',
    'cs'        => 'http://www.mozillamessaging.com/cs/',
    'da'        => 'http://www.mozillamessaging.com/da/',
    'nl'        => 'http://www.mozillamessaging.com/nl/',
    'en-GB'     => 'http://www.mozillamessaging.com/en-GB/',
    'en-US'     => 'http://www.mozillamessaging.com/',
    'et'        => 'http://www.mozillamessaging.com/et/',
    'fi'        => 'http://www.mozillamessaging.com/fi/',
    'fr'        => 'http://www.mozillamessaging.com/fr/',
    'fy-NL'     => 'http://www.mozillamessaging.com/fy-NL/',
    'gl'        => 'http://www.mozillamessaging.com/gl/',
    'ka'        => 'http://www.mozillamessaging.com/ka/',
    'de'        => 'http://www.mozillamessaging.com/de/',
    'el'        => 'http://www.mozillamessaging.com/el/',
    'he'        => 'http://www.mozillamessaging.com/he/',
    'hu'        => 'http://www.mozillamessaging.com/hu/',
    'is'        => 'http://www.mozillamessaging.com/is/',
    'id'        => 'http://www.mozillamessaging.com/id/',
    'ga-IE'     => 'http://www.mozillamessaging.com/ga-IE/',
    'ga-IE'     => 'http://www.mozillamessaging.com/gd/',
    'it'        => 'http://www.mozillamessaging.com/it/',
    'ja'        => 'http://mozilla.jp/thunderbird/',
    'ko'        => 'http://www.mozillamessaging.com/ko/',
    'lt'        => 'http://www.mozillamessaging.com/lt/',
    'nb-NO'     => 'http://www.mozillamessaging.com/nb-NO/',
    'nn-NO'     => 'http://www.mozillamessaging.com/nn-NO/',
    'pl'        => 'http://www.mozillamessaging.com/pl/',
    'pt-BR'     => 'http://www.mozillamessaging.com/pt-BR/',
    'pt-PT'     => 'http://www.mozillamessaging.com/pt-PT/',
    'pa-IN'     => 'http://www.mozillamessaging.com/pa-IN/',
    'ro'        => 'http://www.mozillamessaging.com/ro/',
    'ru'        => 'http://www.mozillamessaging.com/ru/',
    'sr'        => 'http://www.mozillamessaging.com/sr/',
    'si'        => 'http://www.mozillamessaging.com/si/',
    'sk'        => 'http://www.mozillamessaging.com/sk/',
    'sl'        => 'http://www.mozillamessaging.com/sl/',
    'es-AR'     => 'http://www.mozillamessaging.com/es-AR/',
    'es-ES'     => 'http://www.mozillamessaging.com/es-ES/',
    'sv-SE'     => 'http://www.mozillamessaging.com/sv-SE/',
    'ta-LK'     => 'http://www.mozillamessaging.com/ta-LK/',
    'tr'        => 'http://www.mozillamessaging.com/tr/',
    'uk'        => 'http://www.mozillamessaging.com/uk/',
    'vi'        => 'http://www.mozillamessaging.com/vi/',

);

/* Despite our having in-product pages for all the languages above, we don't have
 * full site translations for all of them.  We can't have them all showing up in the
 * footer language select box then, because we wouldn't know where to send them.  So,
 * these languages are the ones that will show up in the footer select box.  As site
 * translations become available, copy the language from $native_languages to this
 * array.  When this array and $native_languages are the same, delete this array, and
 * change the getLangLinksSelect() function in includes/functions.inc.php to run off
 * $native_languages. */
$language_select_list = array(
    'af'        => 'Afrikaans',
    'ar'        => '&#1593;&#1585;&#1576;&#1610;',
    'ast'       => 'Asturianu',
    'eu'        => 'Euskara',
    'be'        => 'Беларуская',
    'bg'        => '&#1041;&#1098;&#1083;&#1075;&#1072;&#1088;&#1089;&#1082;&#1080;',
    'ca'        => 'Catal&#224;',
    'zh-CN'     => '&#20013;&#25991; (&#31616;&#20307;)',
    'zh-TW'     => '&#27491;&#39636;&#20013;&#25991; (&#32321;&#39636;)',
    'cs'        => '&#268;e&#353;tina',
    'da'        => 'Dansk',
    'de'        => 'Deutsch',
    'es-ES'        => 'Espa&#241;ol',
    'eu'        => 'Euskara',
    'en-GB'     => 'English (British)',
    'en-US'     => 'English (US)',
    'et'        => 'Eesti keel',
    'fi'        => 'Suomi',
    'fr'        => 'Fran&#231;ais',
    'fy-NL'     => 'Frysk',
    'gd'        => 'Gàidhlig',
    'gl'        => 'Galego',
    'ka'        => '&#4325;&#4304;&#4320;&#4311;&#4323;&#4314;&#4312;&#32;&#4308;&#4316;&#4304;',
    'el'        => '&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;',
    'he'        => '&#1506;&#1489;&#1512;&#1497;&#1514;',
    'hu'        => 'Magyar',
    'id'        => 'Bahasa Indonesia',
    'is'        => '&#205;slenska',
    'ga-IE'     => 'Gaeilge',
    'it'        => 'Italiano',
    'ja'        => '&#26085;&#26412;&#35486;',
    'ko'        => '&#54620;&#44397;&#50612;',
    'lt'        => 'Lietuvi&#371;',
    'hu'        => 'Magyar',
    'nl'        => 'Nederlands',
    'nb-NO'     => 'Norsk bokm&#229;l',
    'nn-NO'     => 'Norsk nynorsk',
    'pl'        => 'Polski',
    'pt-BR'     => 'Portugu&#234;s (do Brasil)',
    'pt-PT'     => 'Portugu&#234;s (Europeu)',
    'pa-IN'     => '&#2602;&#2672;&#2588;&#2622;&#2604;&#2624;',
    'ro'        => 'Rom&#226;n&#259;',
    'ru'        => '&#1056;&#1091;&#1089;&#1089;&#1082;&#1080;&#1081;',
    'sr'        => '&#1057;&#1088;&#1087;&#1089;&#1082;&#1080;',
    'si'        => '&#3523;&#3538;&#3458;&#3524;&#3517;',
    'sq'        => 'Shqip',
    'sk'        => 'Sloven&#269;ina',
    'sl'        => 'Slovensko',
    'es-AR'     => 'Espa&#241;ol (Argentina)',
    'es-ES'     => 'Espa&#241;ol (Espa&#241;a)',
    'sv-SE'     => 'Svenska',
    'ta-LK'     => 'Tamil (Sri Lanka)',
    'tr'        => 'T&#252;rk&#231;e',
    'vi'        => 'Tiếng Việt',
    'uk'        => '&#1059;&#1082;&#1088;&#1072;&#1111;&#1085;&#1089;&#1100;&#1082;&#1072;',
);
/*** END TEMPORARY CODE ***/
?>
