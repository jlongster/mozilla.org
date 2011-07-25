// DHTML Checkbox Widget
// Usage:
//     <span class="axs checkbox checked">Include decorative fruit basket</span>

var kCheckImage = "checked.gif";
var kUncheckImage = "unchecked.gif";
var ELEMENT_NODE = 1;  // IE does not understand Node.ELEMENT_NODE nor nodeObj.ELEMENT_NODE
// Mouse and keyboard event handlers for controls
function initCheckbox(checkbox)
{
  if (checkbox.tabIndex <= 0) {
    checkbox.tabIndex = "0";
  }
  var newImg = document.createElement("img");
  checkImg = checkbox.insertBefore(newImg, checkbox.firstChild);
  checkImg.setAttribute("alt", "");
  checkImg.setAttribute("role", "wairole:presentation");
  displayCheckbox(checkbox);
  addEvent(checkbox, "keydown", handleCheckboxEvent);
  addEvent(checkbox, "click", handleCheckboxEvent);
};

function displayCheckbox(checkbox)
{
  var checkImg = checkbox.getElementsByTagName("img")[0]; 	
  var checked = (getAttrNS(checkbox, NS_STATE, "checked") == "true");
  checkImg.src = checked ? kCheckImage : kUncheckImage;
};

function handleCheckboxEvent(event)
{
  var bEventContinue = true; // Browser can still use event
  try {
    if ((event.type == "click" && event.button == 0) ||
        (event.type == "keydown" && event.keyCode == 32)) {
      // Toggle checkbox
      var checkbox = getTarget(event);
      // event could be coming from img
      if (checkbox.tagName.toLowerCase() == 'img') {
        checkbox = checkbox.parentNode;
      }
      var checked = (getAttrNS(checkbox, NS_STATE, "checked") == "true");
      setAttrNS(checkbox, NS_STATE, "checked", checked ? "false" : "true");
      displayCheckbox(checkbox);
      bEventContinue = false;  // Do not continue propagating event
    }
  } catch (error) {
    bEventContinue = true;
  }
  return bEventContinue;
};
