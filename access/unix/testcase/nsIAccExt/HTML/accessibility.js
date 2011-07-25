 // Descrpt: basic functions. 
 // Author: jessie.li@sun.com
 // Copyright (C) 2002 Sun Microsystems Corp.  All Rights Reserved.
  

//********************* Cookie functions **********************************

function createCookie(name,value,days)
{
  if (days)
  {
    var date = new Date();
    date.setTime(date.getTime()+(days*24*60*60*1000));
    var expires = "; expires="+date.toGMTString();
  }
  else expires = "";

  document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name)
{
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for(var i=0;i < ca.length;i++)
  {
    var c = ca[i];
    while (c.charAt(0)==' ')
      c = c.substring(1,c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
  }
  return null;
}

function eraseCookie(name)
{
  createCookie(name,"",-1);
}

//********************* End of cookie functions ****************************

//************************ General functions *******************************

function displayResults(results)
{
    document.write(results);
    
}

//********************* End of General functions ***************************

//************** functions for nsIAccessibleService interface **************

function getAccessibleSelectionNode(startNode)
{
  var accessibleService = null;
  var accessibleNode = null;
  try{
   netscape.security.PrivilegeManager.enablePrivilege("UniversalBrowserRead");
   netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");

   accessibleService = Components.classes["@mozilla.org/accessibilityService;1"].createInstance();
   accessibleService = accessibleService.QueryInterface(Components.interfaces.nsIAccessibilityService);
  }
  catch(e){
   alert("Error getting accessibility service");
  }

  try{
   netscape.security.PrivilegeManager.enablePrivilege("UniversalBrowserRead");
   netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");

   accessibleNode = accessibleService.getAccessibleFor(startNode).QueryInterface(Components.interfaces.nsIAccessibleSelectable);
   
   return accessibleNode;
  }
  catch(e){
   return "Exception";
  }
}


function getAccessibleEditableTextNode(startNode)
{
  var accessibleService = null;
  var accessibleNode = null;
  try{
   netscape.security.PrivilegeManager.enablePrivilege("UniversalBrowserRead");
   netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");

   accessibleService = Components.classes["@mozilla.org/accessibilityService;1"].createInstance();
   accessibleService = accessibleService.QueryInterface(Components.interfaces.nsIAccessibilityService);
  }
  catch(e){
   alert("Error getting accessibility service");
  }

  try{
   netscape.security.PrivilegeManager.enablePrivilege("UniversalBrowserRead");
   netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");

   accessibleNode = accessibleService.getAccessibleFor(startNode).QueryInterface(Components.interfaces.nsIAccessibleEditableText);
   
   return accessibleNode;
  }
  catch(e){
   return "Exception";
  }
}


function getAccessibleActionNode(startNode)
{
  var accessibleService = null;
  var accessibleNode = null;
  try{
   netscape.security.PrivilegeManager.enablePrivilege("UniversalBrowserRead");
   netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");

   accessibleService = Components.classes["@mozilla.org/accessibilityService;1"].createInstance();
   accessibleService = accessibleService.QueryInterface(Components.interfaces.nsIAccessibilityService);
  }
  catch(e){
   alert("Error getting accessibility service");
  }

  try{
   netscape.security.PrivilegeManager.enablePrivilege("UniversalBrowserRead");
   netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");

   accessibleNode = accessibleService.getAccessibleFor(startNode).QueryInterface(Components.interfaces.nsIAccessibleAction);
   
   return accessibleNode;
  }
  catch(e){
   return "Exception";
  }
}


function getAccessibleHyperLinkNode(startNode)
{
  var accessibleService = null;
  var accessibleNode = null;
  try{
   netscape.security.PrivilegeManager.enablePrivilege("UniversalBrowserRead");
   netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");

   accessibleService = Components.classes["@mozilla.org/accessibilityService;1"].createInstance();
   accessibleService = accessibleService.QueryInterface(Components.interfaces.nsIAccessibilityService);
  }
  catch(e){
   alert("Error getting accessibility service");
  }

  try{
   netscape.security.PrivilegeManager.enablePrivilege("UniversalBrowserRead");
   netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");

   accessibleNode = accessibleService.getAccessibleFor(startNode).QueryInterface(Components.interfaces.nsIAccessibleHyperLink);
   return accessibleNode;
  }
  catch(e){
   return "Exception";
  }
}


function getAccessibleHyperTextNode(startNode)
{
  var accessibleService = null;
  var accessibleNode = null;
  try{
   netscape.security.PrivilegeManager.enablePrivilege("UniversalBrowserRead");
   netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");

   accessibleService = Components.classes["@mozilla.org/accessibilityService;1"].createInstance();
   accessibleService = accessibleService.QueryInterface(Components.interfaces.nsIAccessibilityService);
  }
  catch(e){
   alert("Error getting accessibility service");
  }

  try{
   netscape.security.PrivilegeManager.enablePrivilege("UniversalBrowserRead");
   netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");

   accessibleNode = accessibleService.getAccessibleFor(startNode).QueryInterface(Components.interfaces.nsIAccessibleHyperText);
   
   return accessibleNode;
  }
  catch(e){
   return "Exception";
  }
}


function getAccessibleTableNode(startNode)
{
  var accessibleService = null;
  var accessibleNode = null;
  try{
   netscape.security.PrivilegeManager.enablePrivilege("UniversalBrowserRead");
   netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");

   accessibleService = Components.classes["@mozilla.org/accessibilityService;1"].createInstance();
   accessibleService = accessibleService.QueryInterface(Components.interfaces.nsIAccessibilityService);
  }
  catch(e){
   alert("Error getting accessibility service");
  }

  try{
   netscape.security.PrivilegeManager.enablePrivilege("UniversalBrowserRead");
   netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");

   accessibleNode = accessibleService.getAccessibleFor(startNode).QueryInterface(Components.interfaces.nsIAccessibleTable);
   
   return accessibleNode;
  }
  catch(e){
   return "Exception";
  }
}


function getAccessibleTextNode(startNode)
{
  var accessibleService = null;
  var accessibleNode = null;
  try{
   netscape.security.PrivilegeManager.enablePrivilege("UniversalBrowserRead");
   netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");

   accessibleService = Components.classes["@mozilla.org/accessibilityService;1"].createInstance();
   accessibleService = accessibleService.QueryInterface(Components.interfaces.nsIAccessibilityService);
  }
  catch(e){
   alert("Error getting accessibility service");
  }

  try{
   netscape.security.PrivilegeManager.enablePrivilege("UniversalBrowserRead");
   netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");

   accessibleNode = accessibleService.getAccessibleFor(startNode).QueryInterface(Components.interfaces.nsIAccessibleText);
   
   return accessibleNode;
  }
  catch(e){
   return "Exception";
  }
}


function getAccessibleValueNode(startNode)
{
  var accessibleService = null;
  var accessibleNode = null;
  try{
   netscape.security.PrivilegeManager.enablePrivilege("UniversalBrowserRead");
   netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");

   accessibleService = Components.classes["@mozilla.org/accessibilityService;1"].createInstance();
   accessibleService = accessibleService.QueryInterface(Components.interfaces.nsIAccessibilityService);
  }
  catch(e){
   alert("Error getting accessibility service");
  }

  try{
   netscape.security.PrivilegeManager.enablePrivilege("UniversalBrowserRead");
   netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");

   accessibleNode = accessibleService.getAccessibleFor(startNode).QueryInterface(Components.interfaces.nsIAccessibleValue);
   
   return accessibleNode;
  }
  catch(e){
   return "Exception";
  }
}
//************** End of functions for nsIAccessibleService interface ***********


//**************** functions of nsIAccessible Interface ************************


//************nsIAccessibleTable*******************

// This function will test the attribute caption.
function getCaption(accNode)
{
 try{
  return accNode.caption;
 }
 catch(e){
  return(e);
 }
}

// This function will test the attribute summary.
function getSummary(accNode)
{
 try{
  return accNode.summary;
 }
 catch(e){
  return(e);
 }
}

// This function will test the attribute columns.
function getColumns(accNode)
{
 try{
  return accNode.columns;
 }
 catch(e){
  return(e);
 }
}

// This function will test the attribute rows.
function getRows(accNode)
{
  try{
   return accNode.rows;
  }
  catch(e){
    return(e);
  }
}

//***************end of nsIAccessibleTable**************

//***************nsIAccessibleSelection*****************

// This function will test the attribute selectionCount.
function getSelectionCount(accNode)
{
  try{
   return accNode.selectionCount;
  }
  catch(e){
    return(e);
  }
}

//**********end of nsIAccessibleSelection*****************

//***************nsIAccessibleHyperLink*******************
//This function will test the attribute links.
function getLinks(accNode)
{
  try{
   return accNode.links;
  }
  catch(e){
    return(e);
  }
}

//This function will test the attribute getStartIdex.
function getStartIndex(accNode)
{
  try{
   return accNode.getStartIndex;
  }
  catch(e){
    return(e);
  }
}

//This function will text the attribute getEndIndex.
function getEndIndex(accNode)
{
  try{
   return accNode.getEndIndex;
  }
  catch(e){
    return(e);
  }
}
//**********end of nsIAccessibleHyperLink*****************


//****************** End of functions of nsIAccessible Interface *************