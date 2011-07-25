var NS_STATE = "http://www.w3.org/2005/07/aaa";
var DOM_VK_LEFT = 37;
var DOM_VK_UP = 38;
var DOM_VK_RIGHT = 39;
var DOM_VK_DOWN = 40;
var DOM_VK_HOME = 36;
var DOM_VK_END = 35;

function addEvent(elmTarget, sEventName, fCallback)
{
  var returnValue = false;
  if (elmTarget.addEventListener) {
    elmTarget.addEventListener(sEventName, fCallback, false);
    returnValue = true;
  }
  else if (elmTarget.attachEvent) {
    returnValue = elmTarget.attachEvent('on' + sEventName, fCallback);
  }
  return returnValue;
};

function addChangeEvent(elmTarget, fCallback)
{
  var returnValue = false;
  if (elmTarget.addEventListener) {
    elmTarget.addEventListener("DOMAttrModified", fCallback, false);
    returnValue = true;
  }
  else if (elmTarget.attachEvent) {  // IE
    returnValue = elmTarget.attachEvent("onpropertychange", fCallback);
  }
  return returnValue; 
};

// set up a mapping of the namespace URIs with the name that is used - must match the xmlns mappings above
var nsMapping = new Array();
nsMapping["http://www.w3.org/2005/07/aaa"] = "aaa:";

function setAttrNS(elmTarget, uriNamespace, sAttrName, sAttrValue) {
  if (typeof document.documentElement.setAttributeNS != 'undefined') {
    elmTarget.setAttributeNS(uriNamespace, sAttrName, sAttrValue);
  } else {
    elmTarget.setAttribute(nsMapping[uriNamespace] + sAttrName, sAttrValue);
  }
};

function getAttrNS(elmTarget, uriNamespace, sAttrName) {
  if (typeof document.documentElement.getAttributeNS != 'undefined') {
    return elmTarget.getAttributeNS(uriNamespace, sAttrName);
  } else {
    return elmTarget.getAttribute(nsMapping[uriNamespace] + sAttrName);
  }
};

function removeAttrNS(elmTarget, uriNamespace, sAttrName) {
  if (typeof document.documentElement.removeAttributeNS != 'undefined') {
    return elmTarget.removeAttributeNS(uriNamespace,sAttrName);
  } else {
    return elmTarget.removeAttribute(nsMapping[uriNamespace] + sAttrName);
  }
};

function hasAttrNS(elmTarget, uriNamespace,sAttrName) {
  if (typeof document.documentElement.hasAttributeNS != 'undefined') {
    return elmTarget.hasAttributeNS(uriNamespace, sAttrName);
  } else {
    return (getAttrNS(elmTarget, uriNamespace,sAttrName) != null);
  }
};

function hasAttribute(elmTarget, sAttrName) {
  if (typeof document.documentElement.hasAttribute != 'undefined') {
    return elmTarget.hasAttribute(sAttrName);
  } else {
    return (elmTarget.getAttribute(sAttrName) != null);
  }
};

function setRolesAndStates(elmAccessible)
{
  var STATE_MACHINE_BEGIN = 0;
  var STATE_MACHINE_IN_ACCESSIBLE = 1;
  var STATE_MACHINE_ROLE_IS_SET = 2;

  var sClass = elmAccessible.className;
  var arClassNames = sClass.split(' ');
  var machineState = STATE_MACHINE_BEGIN;
  var role = "";

  for (j = 0; j < arClassNames.length; j++) {
    var sClass = arClassNames[j].replace(/ /g, '');
    if (!sClass) { continue; }
    if (sClass == 'axs') {
      /* found "axs" accessible keyword, rest of class is roles and states */
      machineState = STATE_MACHINE_IN_ACCESSIBLE;
    } else if (machineState == STATE_MACHINE_IN_ACCESSIBLE) {
      /* found role, set it and move on */
      elmAccessible.setAttribute("role", "wairole:" + sClass);
      //alert('Role of ' + elmAccessible.nodeName + ' ' + elmAccessible.id + ' is ' + elmAccessible.getAttribute("role"));
      machineState = STATE_MACHINE_ROLE_IS_SET;
      role = sClass;
    } else if (machineState == STATE_MACHINE_ROLE_IS_SET) {
      /* found state, set it and look for more */
      if (sClass.indexOf('-') != -1) {
        /* state has specific value, parse it out and set it */
        var arValue = sClass.split(/-/);
        /* arValue[0] is state name, arValue[1] is value */
        setAttrNS(elmAccessible, NS_STATE, arValue[0], arValue[1]);
      } else {
        /* state is simply a name, value is true - make it a string to match other values as strings*/
        setAttrNS(elmAccessible, NS_STATE, sClass, "true");
      }
    }
  }
  if (role != "") {
    initWidget(elmAccessible, role);
  }
};

function initWidget(elmAccessible, sClass)
{
  // Add widget-specific init routines as we go
  switch (sClass) {
    // Simple widgets
    case 'button': case 'buttonsubmit': case 'checkboxtristate':
    case 'secret': case 'spinbutton':
    case 'textarea': case 'textfield':
      if (elmAccessible.tabIndex <= 0)
        elmAccessible.tabIndex = "0";
      break;
    case 'checkbox':
      initCheckbox(elmAccessible);
      break;
    case 'slider':
      initSlider(elmAccessible);
      break;
    // Focusable children of container widgets
    case 'columnheader': case 'gridcell': case 'listitem':
    case 'gridcell': case 'link': case 'menuitem':
    case 'menuitemcheckable': case 'menuitemradio':
    case 'radio':
         elmAccessible.tabIndex = "-1";
     break;
    case 'alert':
      initAlert(elmAccessible);
      break;
    case 'treeitem':
	  initTreeItem(elmAccessible);
      break;
  }
};

function initApp(elmRoot)
{
  if (document.isInitialized) {
    return;  // Avoid second initialization -- we inited early because of DOMContentLoaded
  }
  document.isInitialized = true;
  if ((!elmRoot) || (!elmRoot.getElementsByTagName)) {
    elmRoot = document.body;
  }
  if (/axs /.test(elmRoot.className)) {
    setRolesAndStates(elmRoot);  // First do root element
  }
  if (document.evaluate) {
    var snapAccessibleElements = document.evaluate(".//*[contains(@class, 'axs ')]", elmRoot, null, XPathResult.UNORDERED_NODE_SNAPSHOT_TYPE, null);
    for (var i = snapAccessibleElements.snapshotLength - 1; i >= 0; i--) {
      setRolesAndStates(snapAccessibleElements.snapshotItem(i));
    }
  } else {
    var arElements = (typeof elmRoot.all != 'undefined') ? elmRoot.all : elmRoot.getElementsByTagName('*');
    var iElementCount = arElements.length;
    for (var i = 0; i < iElementCount; i++) {
      if (/axs /.test(arElements[i].className)) {
        setRolesAndStates(arElements[i]);
      }
    }
  }
};

/*
* @method public getTarget() - helper function to extract the element which fired the event from the event object.
*	@param event - event object
*	@return - the appropriate target based on the varibles supported in the event object.
*/
function getTarget(event)
{
  var target = null;
  if (event.target) {
    target = event.target;
  }
  else if (event.srcElement) {
    target = event.srcElement;
  }
  return target;
};

function setStyle(theObj, styleName, styleValue, priority)
{
  var bSuccess = false;

  try {
    if (theObj.style && theObj.style.setProperty) {
      theObj.style.setProperty(styleName, styleValue,priority);
      bSuccess = true;
    }
  } catch (ex) {
    //alert('exception caught setting style: ' + ex.message); // cannot do anything try the next method
  }
  if (!bSuccess) {
    try {
      theObj.style[styleName] = styleValue;
      bSuccess = true;
    } catch (exNext) {
      //alert('exception caught setting direct style: ' + exNext.message); // cannot do anything
    }
  }
  return bSuccess;
}; // end of setStyle

// Try to fire early load event -- works in Firefox, to avoid waiting for image loads.
// onload will also call initApp() so initApp() must check to see if already called
// A similar method can be implemented for IE using <script defer ...>
// For more info on IE method, see http://dean.edwards.name/weblog/2005/09/busted/
if (document.addEventListener) {
  document.addEventListener("DOMContentLoaded", initApp, false);
}
