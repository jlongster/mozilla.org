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
  newAlert,setAttribute("role", "wairole:alert");
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
