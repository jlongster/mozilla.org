//assignHelper.js
// helper file to set attributes and event handlers for IE and Mozilla.  Try to make code  based on method support rather than browser
// detection where possible

function setStyle(theObj, styleName, styleValue, priority) {
	var bSuccess = false;
	// first convert any known styleNames
	/*var directName = "";	// name used when setting attribute directly on style object
	switch (styleName) {
		case "class":
			directName = "className";
			break;
		default:
			directName = styleName;
	} */
	try {
		if (theObj.style && theObj.style.setProperty) {
			theObj.style.setProperty(styleName, styleValue,priority);
			bSuccess = true;
		}
	} catch (ex) {
		alert('exception caught setting style: ' + ex.message); // can't do anything try the next method
	}
	if (!bSuccess) {
		try {
			theObj.style[styleName] = styleValue;
			bSuccess = true;
		} catch (exNext) {
			alert('exception caught setting direct style: ' + exNext.message); // can't do anything
		}
	}
	return bSuccess;
} // end of setStyle

function setEvent(theObj, eventName, eventHandler) {
	try {
		theObj.setAttribute(eventName,eventHandler);
	} catch (ex) {
		alert('caught exception is theObj.setAttribute() of an event');
	}

} // end of setEvent


