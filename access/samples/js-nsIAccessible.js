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
  iframe.contentDocument.addEventListener("click",testClicks,false); 
  iframe.contentDocument.addEventListener("mouseover",testMouseOver,false); 
};

function testDOMNode(domNode)
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
    
  updateDisplay(domNode);
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

function updateDisplay(domNode)
{
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
  if (gAccNode) {
    gAccText = gAccNode.QueryInterface(Components.interfaces.nsIAccessibleText);
  }
  if (gAccText) {
    var startOfLineOffset = 0;
    var characterCount = gAccNode.characterCount;
    var before = { }, after = { };
    text = gAccText.getText(0, characterCount);
    for (count = 0; count < characterCount; count ++) {
       gAccNode.getTextAtOffset(count, Components.interfaces.nsIAccessibleText.BOUNDARY_LINE_START,
                                before, after);
       text += "[" + before.value + "," + after.value + "]";
    }
  }
  /*
  gAccHyper = gAccNode.QueryInterface(Components.interfaces.nsIAccessibleHyperText);
  if (gAccHyper) {
    var linkIndex = gAccHyper.getLinkIndex(15);
    text += " [" + linkIndex + "]";
  }
  */
  document.getElementById("text").firstChild.nodeValue = text; 
  try {
    var stateStr = hex(gAccNode.state) + stateToString(gAccNode);
    document.getElementById("state").firstChild.nodeValue = stateStr;
  } catch(ex) {}
};

function testFocus(evt)
{
  if (!document.getElementById("track-focus").checked)
    return;  // Test focus option is off
    
  testDOMNode(evt.target);
};

function testClicks(evt)
{
  if (!document.getElementById("track-clicks").checked)
    return;  // Test clicks option is off

  testDOMNode(evt.target);
};

function testMouseOver(evt)
{
  if (!document.getElementById("track-mouseover").checked)
    return;  // Test clicks option is off

  testDOMNode(evt.target);
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
