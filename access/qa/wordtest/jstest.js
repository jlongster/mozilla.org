/*
 * Javascript-nsIAccessible.js
 */

var gAccNode = null;
var gAccText = null;
var gEditText = null;
var gAccHyper = null;

function getAccessibleFor(domNode)
{
  var accRetrieval = null;
  try {
    accRetrieval = Components.classes["@mozilla.org/accessibleRetrieval;1"].createInstance(Components.interfaces.nsIAccessibleRetrieval);
  }
  catch (ex) { dump ("\nError getting accessibility retrieval service\n" + ex);}

  if (!accRetrieval) {
    alert("No accessible retrieval");
    return null;
  }
   
  try {
    return accRetrieval.getAccessibleFor(domNode);
  } catch(ex) { }
  
  return null;
}   

function setupListeners(iframe)
{
  netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
  iframe.contentDocument.addEventListener("focus",testFocus,false); 
  iframe.contentDocument.addEventListener("mousedown",testClicks,false); 
  iframe.contentDocument.addEventListener("mousemove",testMouseMove,false); 
};

function testDOMNode(domNode, x, y)
{
  var accService = null;
  gAccNode = null;

  netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");

  while (domNode) {
    gAccNode = getAccessibleFor(domNode);
    if (gAccNode)
      break;
    domNode = domNode.parentNode;
  }
    
  updateDisplay(domNode, x, y);
};

function navigateToParent()
{
  netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
  gAccNode = gAccNode.parent;
  updateDisplay();
};

function navigateToPreviousSibling()
{
  netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
  gAccNode = gAccNode.previousSibling;
  updateDisplay();
};

function navigateToNextSibling()
{
  netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
  gAccNode = gAccNode.nextSibling;
  updateDisplay();
};

function navigateToFirstChild()
{
  netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
  gAccNode = gAccNode.firstChild;
  updateDisplay();
};

function navigateToLastChild()
{
  netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
  gAccNode = gAccNode.lastChild;
  updateDisplay();
};

const stateDesc = [
  "unavailable",
  "selected",
  "focused",
  "pressed",
  "checked",
  "mixed",
  "readonly",
  "hottracked",
  "default",
  "expanded",
  "collapsed",
  "busy",
  "floating",
  "marqueed",
  "animated",
  "invisible",
  "offscreen",
  "sizeable",
  "moveable",
  "selfvoicing",
  "focusable",
  "selectable",
  "linked",
  "traversed",
  "multiselectable",
  "extselectable",
  "alert_low",
  "alert_medium",
  "alert_high",
  "protected",
  "haspopup"
];

function stateToString(gAccNode)
{
  var state = gAccNode.state;
  var stateStr = "";
  var states = new Array();
  var i;
  for (i = 0; i < stateDesc.length; i++) {
    if (state & (1 << i)) {
      states.push(stateDesc[i]);
    }
  }
  if (states.length) {
    stateStr = " ( " + states.join(" | ") + " ) ";
  }
  return stateStr;
}

/* Taken from nsProgressDlg.js */
function hex(num)
{
  return "0x" + ("0000000" + Number(num).toString(16)).slice(-8);
}

function updateDisplay(domNode, x, y)
{
  if (typeof domNode == "undefined") {
    domNode = gAccNode.DOMNode;
    x = 0;
    y = 0;
  }
  gAccText = gEditText = null;
  netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
  var infoPanel = document.getElementById("infopanel");
  var warnPanel = document.getElementById("warnpanel");
  if (!gAccNode) {
    infoPanel.setAttribute("class", "hidden");
    warnPanel.setAttribute("class", "visible");
    try { document.getElementById("tagwarn").firstChild.nodeValue = domNode.localName; } catch(ex) {}
    return;
  }
    
  var accessNode = gAccNode.QueryInterface(Components.interfaces.nsIAccessNode);

  infoPanel.setAttribute("class", "visible");
  warnPanel.setAttribute("class", "hidden");
  try { document.getElementById("tag").firstChild.nodeValue = domNode.localName; } catch(ex) {}
  try { document.getElementById("role").firstChild.nodeValue = gAccNode.role; } catch(ex) {}
  try { document.getElementById("name").firstChild.nodeValue = gAccNode.name; } catch(ex) {}
  try { document.getElementById("value").firstChild.nodeValue = gAccNode.value; } catch(ex) {}
  var text = "No nsIAccessibleText";
  gAccText = null;
  var characterCount = 0;
  try {
    gAccText = gAccNode.QueryInterface(Components.interfaces.nsIAccessibleText);
  }
  catch (ex) { }
  
  if (gAccText) {
    var offsetAtPoint = 0;
    if (x > 0 || y > 0) {
      offsetAtPoint = gAccNode.getOffsetAtPoint(x, y, Components.interfaces.nsIAccessibleText.COORD_TYPE_SCREEN);
    }
    document.getElementById("offsetAtPoint").firstChild.nodeValue = offsetAtPoint;
    var startOfLineOffset = 0;
    characterCount = gAccNode.characterCount;
    try { document.getElementById("name").firstChild.nodeValue = gAccNode.name; } catch(ex) {}
    var before = { }, after = { };
    text = "";
    var count = 0;
    var numRadios = document.options.boundaryType.length;
    var value;
   	for (count = 0; count < numRadios; count ++) {
		  if (document.options.boundaryType[count].checked) {
		    value = document.options.boundaryType[count].value;
		    break;
		  }
		}
    var boundaryType;
	  switch (value) {
	    case 'all': boundaryType = -1; break;
	    case 'char': boundaryType = Components.interfaces.nsIAccessibleText.BOUNDARY_CHAR; break;
      case 'sentenceStart': boundaryType = Components.interfaces.nsIAccessibleText.BOUNDARY_SENTENCE_START; break;
      case 'sentenceEnd':  boundaryType = Components.interfaces.nsIAccessibleText.BOUNDARY_SENTENCE_END; break;
	    case 'wordStart': boundaryType = Components.interfaces.nsIAccessibleText.BOUNDARY_WORD_START; break;
	    case 'wordEnd': boundaryType = Components.interfaces.nsIAccessibleText.BOUNDARY_WORD_END; break;
	    case 'lineStart': boundaryType = Components.interfaces.nsIAccessibleText.BOUNDARY_LINE_START; break;
	    case 'lineEnd': boundaryType = Components.interfaces.nsIAccessibleText.BOUNDARY_LINE_END; break;
      case 'attrRange': boundaryType = Components.interfaces.nsIAccessibleText.BOUNDARY_ATTRIBUTE_RANGE; break;
	    default: return;
    }
    if (boundaryType == -1) {
      text = gAccNode.getText(0, characterCount);
    }
    else {
      while (true) {
        text += gAccNode.getTextAtOffset(startOfLineOffset, boundaryType,
                                         before, after);
        if (before.value == after.value) {
          break;
        }
        text += " [" + before.value + "," + after.value + "]" + "  ";
        startOfLineOffset = after.value;
        if (++ count > 15) {
          break;
        }
      }
    }
  }
  document.getElementById("text").firstChild.nodeValue = text; 
  document.getElementById("numchars").firstChild.nodeValue = characterCount;
  try {
    var stateStr = hex(gAccNode.state) + stateToString(gAccNode);
    document.getElementById("state").firstChild.nodeValue = stateStr;
  } catch(ex) {}
};

function targetInTestUI(domNode)
{
  return domNode.ownerDocument.body.id == "acc_info";
};

function testFocus(evt)
{
  if (!document.getElementById("track-focus").checked)
    return;  // Test focus option is off
  if (targetInTestUI(evt.target)) {
    return;
  }
    
  testDOMNode(evt.target, 0, 0);
};

function testClicks(evt)
{
  if (!document.getElementById("track-clicks").checked)
    return;  // Test clicks option is off
  if (targetInTestUI(evt.target)) {
    return;
  }

  testDOMNode(evt.target, evt.screenX, evt.screenY);
};

function testMouseMove(evt)
{
  if (!document.getElementById("track-mousemove").checked)
    return;  // Test clicks option is off
  if (targetInTestUI(evt.target)) {
    return;
  }

  testDOMNode(evt.target, evt.screenX, evt.screenY);
};

function copyText()
{
  try {
    if (gEditText) {
      var start, end;
      gEditText.getSelectionBounds(0, start, end);
      alert(start, end);
      gEditText.copyText(start, end);     
    }
  } catch(ex) { alert(ex); }
};

function pasteText()
{
  try { 
    var accText = gAccNode.QueryInterface(Components.interfaces.nsIAccessibleText);
    if (accText) {
      accText.pasteText(accText.caretOffset);
    }
  } catch(ex) { alert(ex); }
};
