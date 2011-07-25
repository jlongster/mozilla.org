// DHTML Alert
// Usage 1:
//     createAlert(innerAlertHTML, alertParentElement)  // Creates via DOM
//     removeAlert(alertParentElement);   // Remove via DOM
// Usage 2: 
//     <div id="myAlertID" class="axs alert" style="visibility: hidden">Alert text</div>
//     showAlert("myAlertID"); // Show alert via style
//     hideAlert("myElementID");  // Remove alert via style

function initAlert(alertElement)
{
  hideAlert(alertElement);
};

function createAlert(alertParent, alertHTML)
{
  var newAlert = document.createElement("div");
  showAlert(newAlert);
  newAlert.innerHTML = alertHTML;
  newAlert.setAttribute("role", "alert");
  newAlert.className = "alert";
  alertParent.appendChild(newAlert);
};

function removeAlert(alert)
{
  alert.parentNode.removeChild(alert);
};

function showAlert(alertElement)
{
  setStyle(alertElement, "display", "block", "");
};

function hideAlert(alertElement)
{
  setStyle(alertElement, "display", "none", "");
};

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
