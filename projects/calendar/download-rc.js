var gPlatform = PLATFORM_WINDOWS;

var PLATFORM_OTHER    = 0;
var PLATFORM_WINDOWS  = 1;
var PLATFORM_LINUX    = 2;
var PLATFORM_MACOSX   = 3;
var PLATFORM_MAC      = 4;
var PLATFORM_MACOSX_PPC = 5;

if (navigator.platform.indexOf("Win32") != -1)
  gPlatform = PLATFORM_WINDOWS;
else if (navigator.platform.indexOf("Linux") != -1)
  gPlatform = PLATFORM_LINUX;
else if (navigator.userAgent.indexOf("Mac OS X") != -1)
  gPlatform = PLATFORM_MACOSX;
else if (navigator.userAgent.indexOf("MSIE 5.2") != -1)
  gPlatform = PLATFORM_MACOSX;
else if (navigator.platform.indexOf("Mac") != -1)
  gPlatform = PLATFORM_MAC;
else
  gPlatform = PLATFORM_OTHER;

function getPlatformName(aPlatform)
{
  if (aPlatform == PLATFORM_WINDOWS)
    return "Windows";
  if (aPlatform == PLATFORM_LINUX)
    return "Linux i686";
  if (aPlatform == PLATFORM_MACOSX)
    return "Mac OS X";
  if (aPlatform == PLATFORM_MACOSX_PPC)
    return "Mac OS X PowerPC";
  return "Unknown";
}

function getPlatformFileSize(aPlatform, aProduct)
{
  if (aProduct == "sb") {
    if (aPlatform == PLATFORM_WINDOWS)
      return "4.9MB";
    if (aPlatform == PLATFORM_LINUX)
      return "7.9MB";
    if (aPlatform == PLATFORM_MACOSX)
      return "13.5MB";
    if (aPlatform == PLATFORM_MACOSX_PPC)
      return "13.5MB";
  } else if (aProduct == "ln") {
    if (aPlatform == PLATFORM_WINDOWS)
      return "1.9MB";
    if (aPlatform == PLATFORM_LINUX)
      return "2.0MB";
    if (aPlatform == PLATFORM_MACOSX)
      return "2.4MB";
    if (aPlatform == PLATFORM_MACOSX_PPC)
      return "";
  }
  return "Unknown";
}

function getProductName(aProduct)
{
  if (aProduct == "sb") {
    return "sunbird";
  } else if (aProduct == "ln") {
    return "lightning";
  }
  return "Unknown";
}

var gDLVersions = {
  "sb": {
    "0.9rc2": "sunbird-0.9rc2",
    "0.7rc3": "sunbird-0.7rc3",
    "0.7rc2": "sunbird-0.7rc2",
    "0.7rc1": "sunbird-0.7rc1",
    "0.5": "sunbird-0.5",
    "0.3.1": "sunbird-0.3.1",
    "0.3": "sunbird-0.3",
    "0.3a2": "sunbird-0.3a2",
    "0.3a1": "sunbird-0.3a1",
    "0.2": "sunbird-0.2"
  },
  "ln": {
    "0.9rc2": "lightning-0.9rc2",
    "0.7rc3": "lightning-0.7rc3",
    "0.7rc2": "lightning-0.7rc2",
    "0.7rc1": "lightning-0.7rc1",
    "0.5": "lightning-0.5",
    "0.3.1": "lightning-0.3.1",
    "0.3": "lightning-0.3",
    "0.1": "lightning-0.1"
  }
};

function hasMacUniversal(aProduct, aVersion)
{
  return (aProduct == "sb" && aVersion >= "0.3.1") ||
         (aProduct == "ln" && aVersion >= "0.3");
}

function hasMacPowerPC(aProduct, aVersion)
{
  return (aProduct == "sb" && aVersion <= "1.9") || 
         (aProduct == "ln" && aVersion <= "0.2");
}

function getDownloadURLForLanguage(aLangID, aPlatform)
{
  // If we are testing the site locally, give the direct download URL.
  if (window.location.protocol == "file:") {
    var url = "http://download.mozilla.org/?product=";
  }
  // If it is IE/SP2, just give the direct download URL
  //else if (window.navigator.userAgent.indexOf("SV1") != -1) {
  else {
    var url = "http://download.mozilla.org/?product=";
  //} else {
  // If it is *not* IE/SP2, give the download/thankyou page
  //  var url = "/products/download.html?product=";
  }
  var version = aLangID[aLangID.product];
  url += gDLVersions[aLangID.product][version] + "&amp;os=";
  var abCD = aLangID.abCD;

  if (aPlatform == PLATFORM_WINDOWS) {
    url += "win";
  } else if (aPlatform == PLATFORM_LINUX) {
    url += "linux";
  } else if (aPlatform == PLATFORM_MACOSX) {
    url += "osx";
    if (abCD == "ja-JP")
      abCD = "ja-JPM";
    if (abCD == "ja")
      abCD = "ja-JP-mac";
  } else if (aPlatform == PLATFORM_MACOSX_PPC) {
    if (!hasMacUniversal(aLangID.product, version))
      url += "osxppc";
    else
      url += "osxppc";
    if (abCD == "ja-JP")
      abCD = "ja-JPM";
    if (abCD == "ja")
      abCD = "ja-JP-mac";
  } else {
    return "http://www.mozilla.org/projects/calendar/";
  }

  return url + "&amp;lang=" + abCD;
}

// "" for a version means it should be "Not Yet Available" on all.html,
// null means it should not be listed
// A region code of "-" means that no region code should be used.
var gLanguages = {
  "af":  { "za": { sb: null,    ln: null,   name: "Afrikaans",                localName: "Afrikaans" } },
  "ast": { "es": { sb: null,    ln: null,   name: "Asturian",                 localName: "Asturianu" } },
  "ar":  { "-":  { sb: null,    ln: null,   name: "Arabic",                   localName: "\u0639\u0631\u0628\u064A" } },
  "be":  { "-":  { sb: null,    ln: null,   name: "Byelorussian",             localName: "\u0411\u0435\u043B\u0430\u0440\u0443\u0441\u043A\u0430\u044F" } },
  "bg":  { "-":  { sb: null,    ln: null,   name: "Bulgarian",                localName: "\u0411\u044A\u043B\u0433\u0430\u0440\u0441\u043A\u0438" } },
  "br":  { "fr": { sb: null,    ln: null,   name: "Breton",                   localName: "Brezhoneg" } },
  "ca":  { "-":  { sb: "0.9rc2",ln: null,   name: "Catalan",                  localName: "Catal\u00E0" } },
  "cs":  { "-":  { sb: "0.9rc2",ln: null,   name: "Czech",                    localName: "\u010Ce\u0161tina" } },
  "cy":  { "gb": { sb: null,    ln: null,   name: "Welsh",                    localName: "Cymraeg" } },
  "da":  { "-":  { sb: "0.9rc2",ln: null,   name: "Danish",                   localName: "Dansk" } },
  "de":  { "-":  { sb: "0.9rc2",ln: null,   name: "German",                   localName: "Deutsch" } },
  "el":  { "-":  { sb: null,    ln: null,   name: "Greek",                    localName: "\u0395\u03BB\u03BB\u03B7\u03BD\u03B9\u03BA\u03AE" } },
  "en":  { "us": { sb: "0.9rc2",ln: null,   name: "English",                  localName: "English" },
           "gb": { sb: null,    ln: null,   name: "English (British)",        localName: "English (British)" } },
  "es":  { "ar": { sb: "0.9rc2",ln: null,   name: "Spanish (Latin American)", localName: "Espa\u00F1ol (de Am\u00E9rica)" },
           "es": { sb: "0.9rc2",ln: null,   name: "Spanish (Spain)",          localName: "Espa\u00F1ol (de Espa\u00F1a)" } },
  "eu":  { "-":  { sb: "0.9rc2",ln: null,   name: "Basque",                   localName: "Euskara" } },
  "fi":  { "-":  { sb: null,    ln: null,   name: "Finnish",                  localName: "Suomi" } },
  "fr":  { "-":  { sb: "0.9rc2",ln: null,   name: "French",                   localName: "Fran\u00e7ais" } },
  "fy":  { "nl": { sb: null,    ln: null,   name: "Frisian",                  localName: "Frysk" } },
  "ga":  { "ie": { sb: "0.9rc2",ln: null,   name: "Irish",                    localName: "Gaeilge" } },
  "gu":  { "in": { sb: null,    ln: null,   name: "Gujarati",                 localName: "\u0A97\u0AC1\u0A9C\u0AB0\u0ABE\u0AA4\u0AC0" } },
  "he":  { "-":  { sb: null,    ln: null,   name: "Hebrew",                   localName: "\u05E2\u05D1\u05E8\u05D9\u05EA" } },
  "hu":  { "-":  { sb: "0.9rc2",ln: null,   name: "Hungarian",                localName: "Magyar" } },
  "hy":  { "am": { sb: null,    ln: null,   name: "Armenian",                 localName: "\u0540\u0561\u0575\u0565\u0580\u0565\u0576" } },
  "is":  { "-":  { sb: "0.9rc2",ln: null,   name: "Icelandic",                localName: "\00EDslenska" } },
  "it":  { "-":  { sb: "0.9rc2",ln: null,   name: "Italian",                  localName: "Italiano" } },
  "ja":  { "-":  { sb: "0.9rc2",ln: null,   name: "Japanese",                 localName: "\u65E5\u672C\u8A9E" } },
  "ka":  { "-":  { sb: "0.9rc2",ln: null,   name: "Georgian",                 localName: "\u10E5\u10D0\u10E0\u10D7\u10E3\u10DA\u10D8" } },
  "ko":  { "-":  { sb: "0.9rc2",ln: null,   name: "Korean",                   localName: "\uD55C\uAD6D\uC5B4" } },
  "lt":  { "-":  { sb: "0.9rc2",ln: null,   name: "Lithuanian",               localName: "Lietuvi\u0173" } },
  "mk":  { "-":  { sb: null,    ln: null,   name: "Macedonian",               localName: "\u041C\u0430\u043A\u0435\u0434\u043E\u043D\u0441\u043A\u0438" } },
  "mn":  { "-":  { sb: null,    ln: null,   name: "Mongolian",                localName: "\u041C\u043E\u043D\u0433\u043E\u043B" } },
  "nb":  { "no": { sb: "0.9rc2",ln: null,   name: "Norwegian (Bokmal)",       localName: "Norsk bokm\u00E5ll" } },
  "nn":  { "no": { sb: "0.9rc2",ln: null,   name: "Norwegian (Nynorsk)",      localName: "Norsk nynorsk" } },
  "nl":  { "-":  { sb: "0.9rc2",ln: null,   name: "Dutch",                    localName: "Nederlands" } },
  "pa":  { "in": { sb: null,    ln: null,   name: "Punjabi",                  localName: "\u0A2A\u0A70\u0A1C\u0A3E\u0A2C\u0A40" } },
  "pl":  { "-":  { sb: "0.9rc2",ln: null,   name: "Polish",                   localName: "Polski" } },
  "pt":  { "br": { sb: "0.9rc2",ln: null,   name: "Portuguese (Brazilian)",   localName: "Portugu\u00EAs (do Brasil)" },
           "pt": { sb: "0.9rc2",ln: null,   name: "Portuguese (Portugal)",    localName: "Portugu\u00EAs (Europeu)" } },
  "ro":  { "-":  { sb: "0.9rc2",ln: null,   name: "Romanian",                 localName: "Rom\u00E2n\u0103" } },
  "ru":  { "-":  { sb: "0.9rc2",ln: null,   name: "Russian",                  localName: "\u0420\u0443\u0441\u0441\u043A\u0438\u0439" } },
  "sk":  { "-":  { sb: "0.9rc2",ln: null,   name: "Slovak",                   localName: "Slovensk\u00FD" } },
  "sl":  { "-":  { sb: "0.9rc2",ln: null,   name: "Slovenian",                localName: "Slovensko" } },
  "sq":  { "-":  { sb: null,    ln: null,   name: "Albanian",                 localName: "Shqipe" } },
  "sv":  { "se": { sb: "0.9rc2",ln: null,   name: "Swedish",                  localName: "Svenska" } },
  "tr":  { "-":  { sb: null,    ln: null,   name: "Turkish",                  localName: "T\u00FCrk\u00E7e" } },
  "uk":  { "-":  { sb: "0.9rc2",ln: null,   name: "Ukrainian",                localName: "\0423\043A\0440\0430\0457\043D\0441\044C\043A\0430" } },
  "zh":  { "cn": { sb: "0.9rc2",ln: null,   name: "Chinese (Simplified)",     localName: "\u4E2D\u6587 (\u7B80\u4F53)" },
           "tw": { sb: "0.9rc2",ln: null,   name: "Chinese (Traditional)",    localName: "\u6B63\u9AD4\u4E2D\u6587 (\u7E41\u9AD4)" } }
};

function LanguageID(aAB, aCD, aProduct, aBuild)
{
  if (aCD == "-")
    this.abCD = aAB;
  else
    this.abCD = aAB + "-" + aCD.toUpperCase();
  this.product = aProduct;
  for (var prop in aBuild)
    this[prop] = aBuild[prop]
}

function buildValidForPlatform(aLangID, aPlatform)
{
  if ((aLangID.abCD == "gu-IN") &&
      (aPlatform == PLATFORM_MACOSX || aPlatform == PLATFORM_MACOSX_PPC))
    return false;

  return true;
}

function getLanguageIDs(aProduct)
{
  var language = "";
  if (navigator.language)
    language = navigator.language;
  else if (navigator.userLanguage)
    language = navigator.userLanguage;
  else if (navigator.systemLanguage)
    language = navigator.systemLanguage;
  
  // Convert "en" to "en-US" as well since en-US build is the canonical
  // translation, and thus better tested.
  if (language == "" || language == "en")
    language = "en-US";

  // Konqueror uses '_' where other browsers use '-'.
  if (language.indexOf("_") != -1)
    language = language.split("_").join("-");

  language = language.toLowerCase();
  var languageCode = language.split("-")[0];
  var regionCode = language.split("-")[1];

  // String comparison actually works for version numbers.
  var currentVersion = gLanguages["en"]["us"][aProduct];
  var bestVersion = "";
  var ids = [];

  if (gLanguages[languageCode]) {
    var region;
    var build;
    var langid;

    for (region in gLanguages[languageCode]) {
      build = gLanguages[languageCode][region];
      if (build[aProduct] && regionCode == region) {
        langid = new LanguageID(languageCode, regionCode, aProduct, build);
        if (buildValidForPlatform(langid, gPlatform)) {
          ids[ids.length] = langid;
          bestVersion = build[aProduct];
        }
      }
    }

    // We have a localized build for this language, but not this region. 
    // Show all available regions and let the user pick. 

    if (bestVersion != currentVersion) {
      var bestRegionVersion = "";
      for (region in gLanguages[languageCode]) {
        build = gLanguages[languageCode][region];
        if (build[aProduct] > bestVersion) {
          langid = new LanguageID(languageCode, region, aProduct, build);
          if (buildValidForPlatform(langid, gPlatform)) {
            ids[ids.length] = langid;
            if (build[aProduct] > bestRegionVersion)
              bestRegionVersion = build[aProduct];
          }
        }
      }
      if (bestRegionVersion > bestVersion)
        bestVersion = bestRegionVersion;
    }
  }
  if (bestVersion != currentVersion) {
    ids[ids.length] = new LanguageID("en", "us", aProduct, gLanguages["en"]["us"]);
  }

  return ids;
}

function writeDownloadItem(aLanguageID)
{
  var item = gDownloadItemTemplate;
  item = item.replace(/%DOWNLOAD_URL%/g,  getDownloadURLForLanguage(aLanguageID, gPlatform));
  item = item.replace(/%VERSION%/g,       aLanguageID[aLanguageID.product]);
  item = item.replace(/%PLATFORM_NAME%/g, getPlatformName(gPlatform));
  item = item.replace(/%LANGUAGE_NAME%/g, aLanguageID.name);
  item = item.replace(/%FILE_SIZE%/g,     getPlatformFileSize(gPlatform, aLanguageID.product));
  document.writeln(item);
}

function writeDownloadItems(aProduct)
{
  // Show the dynamic links
  if (gPlatform == PLATFORM_MAC) {
    document.writeln(gDownloadItemMacOS9);
  } else if (gPlatform == PLATFORM_OTHER) {
    document.writeln(gDownloadItemOtherPlatform);
  } else {
    var languageIDs = getLanguageIDs(aProduct);
    for (var i = 0; i < languageIDs.length; ++i)
      writeDownloadItem(languageIDs[i]);
  }
}
