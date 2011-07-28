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
      return "5.0MB";
    if (aPlatform == PLATFORM_LINUX)
      return "8.4MB";
    if (aPlatform == PLATFORM_MACOSX)
      return "14MB";
    if (aPlatform == PLATFORM_MACOSX_PPC)
      return "14MB";
  } else if (aProduct == "ln") {
    if (aPlatform == PLATFORM_WINDOWS)
      return "2.0MB";
    if (aPlatform == PLATFORM_LINUX)
      return "2.0MB";
    if (aPlatform == PLATFORM_MACOSX)
      return "2.2MB";
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

    "1.0b1": "sunbird-1.0b1",
    "0.9": "sunbird-0.9",
    "0.8": "sunbird-0.8",
    "0.7": "sunbird-0.7",
    "0.5": "sunbird-0.5",
    "0.3.1": "sunbird-0.3.1",
    "0.3": "sunbird-0.3",
    "0.3a2": "sunbird-0.3a2",
    "0.3a1": "sunbird-0.3a1",
    "0.2": "sunbird-0.2"
  },
  "ln": {

    "0.9": "lightning-0.9",
    "0.8": "lightning-0.8",
    "0.7": "lightning-0.7",
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
  return (aProduct == "sb" && aVersion <= "0.9.5") || 
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
  "af":  { "za": { sb: null, ln: null,   name: "Afrikaans",                localName: "Afrikaans" } },
  "ast": { "es": { sb: null, ln: null,   name: "Asturian",                 localName: "Asturianu" } },
  "ar":  { "-":  { sb: null, ln: null,   name: "Arabic",                   localName: "\u0639\u0631\u0628\u064A" } },
  "be":  { "-":  { sb: null, ln: null,   name: "Byelorussian",             localName: "\u0411\u0435\u043B\u0430\u0440\u0443\u0441\u043A\u0430\u044F" } },
  "bg":  { "-":  { sb: null, ln: null,   name: "Bulgarian",                localName: "\u0411\u044A\u043B\u0433\u0430\u0440\u0441\u043A\u0438" } },
  "br":  { "fr": { sb: null, ln: null,   name: "Breton",                   localName: "Brezhoneg" } },
  "ca":  { "-":  { sb: "1.0b1",ln: null,   name: "Catalan",                  localName: "català-valencià" } },
  "cs":  { "-":  { sb: "1.0b1",ln: null,   name: "Czech",                    localName: "\u010Ce\u0161tina" } },
  "cy":  { "gb": { sb: null, ln: null,   name: "Welsh",                      localName: "Cymraeg" } },
  "da":  { "-":  { sb: "1.0b1",ln: null,   name: "Danish",                   localName: "Dansk" } },
  "de":  { "-":  { sb: "1.0b1",ln: null,   name: "German",                   localName: "Deutsch" } },
  "el":  { "-":  { sb: null, ln: null,   name: "Greek",                      localName: "\u0395\u03BB\u03BB\u03B7\u03BD\u03B9\u03BA\u03AE" } },
  "en":  { "us": { sb: "1.0b1",ln: null,   name: "English",                  localName: "English" },
           "gb": { sb: null, ln: null,   name: "English (British)",          localName: "English (British)" } },
  "es":  { "ar": { sb: "1.0b1",ln: null,   name: "Spanish (Argentina)",      localName: "Español (Argentina)" },
           "es": { sb: "1.0b1",ln: null,   name: "Spanish (Spain)",          localName: "Español (de España)" } },
  "et":  { "-":  { sb: "1.0b1",ln: null,   name: "Estonian",                 localName: "Eesti keel" } },
  "eu":  { "-":  { sb: "1.0b1",ln: null,   name: "Basque",                   localName: "Euskara" } },
  "fi":  { "-":  { sb: null, ln: null,   name: "Finnish",                    localName: "Suomi" } },
  "fr":  { "-":  { sb: "1.0b1",ln: null,   name: "French",                   localName: "Français" } },
  "fy":  { "nl": { sb: "1.0b1", ln: null,   name: "Frisian",                 localName: "Frysk" } },
  "ga":  { "ie": { sb: "1.0b1",ln: null,   name: "Irish",                    localName: "Gaeilge" } },
  "gl":  { "-":  { sb: "1.0b1",ln: null,   name: "Galician",                 localName: "Galego" } },
  "gu":  { "in": { sb: null, ln: null,   name: "Gujarati",                   localName: "\u0A97\u0AC1\u0A9C\u0AB0\u0ABE\u0AA4\u0AC0" } },
  "he":  { "-":  { sb: "1.0b1", ln: null,   name: "Hebrew",                  localName: "\u05E2\u05D1\u05E8\u05D9\u05EA" } },
  "hu":  { "-":  { sb: "1.0b1",ln: null,   name: "Hungarian",                localName: "Magyar" } },
  "hy":  { "am": { sb: null, ln: null,   name: "Armenian",                   localName: "\u0540\u0561\u0575\u0565\u0580\u0565\u0576" } },
  "id":  { "-":  { sb: "1.0b1",ln: null,   name: "Indonesian",               localName: "Bahasa Indonesia" } },
  "is":  { "-":  { sb: "1.0b1",ln: null,   name: "Icelandic",                localName: "Íslenska" } },
  "it":  { "-":  { sb: "1.0b1",ln: null,   name: "Italian",                  localName: "Italiano" } },
  "ja":  { "-":  { sb: "1.0b1",ln: null,   name: "Japanese",                 localName: "\u65E5\u672C\u8A9E" } },
  "ka":  { "-":  { sb: "1.0b1",ln: null,   name: "Georgian",                 localName: "\u10E5\u10D0\u10E0\u10D7\u10E3\u10DA\u10D8" } },
  "ko":  { "-":  { sb: "1.0b1",ln: null,   name: "Korean",                   localName: "\uD55C\uAD6D\uC5B4" } },
  "lt":  { "-":  { sb: "1.0b1",ln: null,   name: "Lithuanian",               localName: "Lietuvi\u0173" } },
  "mk":  { "-":  { sb: null, ln: null,   name: "Macedonian",                 localName: "\u041C\u0430\u043A\u0435\u0434\u043E\u043D\u0441\u043A\u0438" } },
  "mn":  { "-":  { sb: null, ln: null,   name: "Mongolian",                  localName: "\u041C\u043E\u043D\u0433\u043E\u043B" } },
  "nb":  { "no": { sb: "1.0b1",ln: null,   name: "Norwegian (Bokmål)",       localName: "Norsk bokmål" } },
  "nn":  { "no": { sb: "1.0b1",ln: null,   name: "Norwegian (Nynorsk)",      localName: "Norsk nynorsk" } },
  "nl":  { "-":  { sb: "1.0b1",ln: null,   name: "Dutch",                    localName: "Nederlands" } },
  "pa":  { "in": { sb: "1.0b1", ln: null,   name: "Punjabi",                 localName: "\u0A2A\u0A70\u0A1C\u0A3E\u0A2C\u0A40" } },
  "pl":  { "-":  { sb: "1.0b1",ln: null,   name: "Polish",                   localName: "Polski" } },
  "pt":  { "br": { sb: "1.0b1",ln: null,   name: "Portuguese (Brazilian)",   localName: "Português (do Brasil)" },
           "pt": { sb: "1.0b1",ln: null,   name: "Portuguese (Portugal)",    localName: "Português (Europeu)" } },
  "ro":  { "-":  { sb: "1.0b1",ln: null,   name: "Romanian",                 localName: "român\u0103" } },
  "ru":  { "-":  { sb: "1.0b1",ln: null,   name: "Russian",                  localName: "\u0420\u0443\u0441\u0441\u043A\u0438\u0439" } },
  "si":  { "-":  { sb: "1.0b1",ln: null,   name: "Sinhala",                  localName: "Sinhala" } },
  "sk":  { "-":  { sb: "1.0b1",ln: null,   name: "Slovak",                   localName: "sloven\u010Dina" } },
  "sl":  { "-":  { sb: null,ln: null,   name: "Slovenian",                   localName: "Slovensko" } },
  "sq":  { "-":  { sb: null, ln: null,   name: "Albanian",                   localName: "Shqipe" } },
  "sv":  { "se": { sb: null,ln: null,   name: "Swedish",                     localName: "Svenska" } },
  "tr":  { "-":  { sb: null, ln: null,   name: "Turkish",                    localName: "T00FCrk00E7e" } },
  "uk":  { "-":  { sb: null,ln: null,   name: "Ukrainian",                   localName: "\u0423\u043A\u0440\u0430\u0457\u043D\u0441\u044C\u043A\u0430" } },
  "vi":  { "-":  { sb: null,ln: null,   name: "Vietnamese",                  localName: "Ti\u1EBFng Vi\u1EC7t" } },
  "zh":  { "cn": { sb: "1.0b1",ln: null,   name: "Chinese (Simplified)",     localName: "\u4E2D\u6587 (\u7B80\u4F53)" },
           "tw": { sb: null,ln: null,   name: "Chinese (Traditional)",       localName: "\u6B63\u9AD4\u4E2D\u6587 (\u7E41\u9AD4)" } }
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
