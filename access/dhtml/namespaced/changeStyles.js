// functions for changing style rules

function changeStyleRule(oRule, styleName, styleValue) {
	if (oRule.style && oRule.style.setProperty) {
			oRule.style.setProperty(styleName, styleValue,"");
			//alert(oRule.style.getPropertyValue(styleName));
	}
}


// You must specify a "title" attribute in <style> tag or <link> tag for Mozilla.
function pageGetStyleSheet(sID,doc) {
	if(!doc)doc=document;
	if(!sID)
		return doc.styleSheets[0];

	if (doc.all) {
		return doc.styleSheets[sID];
	} else {
		for (var i = 0; i < doc.styleSheets.length; i++) {
			var oSS = doc.styleSheets[i];
			if (oSS.title == sID) return oSS;
		}
	}
}

function cssGetRules(oSS){
	return (document.all ? oSS.rules : oSS.cssRules);
}


// SIMPLE function to find a particular rule selector
function cssGetRule(rulesList, ruleIdent) {
	var foundRule = null;
	for (var i=0; i < rulesList.length; i++ ) {
		var sText = rulesList[i].selectorText;
		if (sText != "undefined" && sText != null) {
			if (sText.indexOf(ruleIdent) > -1 ) {
				foundRule = rulesList[i];
				break;
			}
		}
	}
	return foundRule;
}