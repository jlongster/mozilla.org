// Dynamic slider widget
// Usage:
//     <span class="axs slider valuemin-0 valuenow-33 valuemax-50" title="My slider">--</span>

// Mouse and keyboard event handlers for controls
function initSlider(slider)
{
  var textNode = document.createTextNode("");
  slider.appendChild(textNode);
  displaySlider(slider);
  if (slider.tabIndex <= 0) {
    slider.tabIndex = "0";
  }
  addChangeEvent(slider, handleSliderChange);
  addEvent(slider, "keydown", handleSliderEvent);
  addEvent(slider, "click", handleSliderEvent);
};

function displaySlider(slider)
{
  var valueNow = parseInt(getAttrNS(slider, NS_STATE, "valuenow"));
  var valueMin = parseInt(getAttrNS(slider, NS_STATE, "valuemin"));
  var valueMax = parseInt(getAttrNS(slider, NS_STATE, "valuemax"));

  // I'm sure there's something better than using a loop, but I don't feel like looking it up right now
  var sliderText = "(";
  for (var count = valueMin; count < valueNow; count ++) {
    sliderText += "-";
  }
  sliderText += "|";
  for (var count = valueNow; count < valueMax; count ++) {
    sliderText += "-";
  }
  sliderText += ")";
  slider.firstChild.data = sliderText;
  return false;
}

function handleSliderChange(event)
{
  var slider = getTarget(event);
  displaySlider(slider);
}

function handleSliderEvent(event)
{
  var slider = getTarget(event);
  
  while (slider.getAttribute("role") != "wairole:slider") {
    slider = slider.parentNode;
  }

  var valueNow = parseInt(getAttrNS(slider, NS_STATE, "valuenow"));
  var valueMin = parseInt(getAttrNS(slider, NS_STATE, "valuemin"));
  var valueMax = parseInt(getAttrNS(slider, NS_STATE, "valuemax"));
  
  var delta = 0;
  if (event.type == "click") {
    //alert(event.clientX);
    // How do we find the x position relative to the start and end of our span?
  }
  else if (event.keyCode == DOM_VK_LEFT) {
    delta = -5;
  }
  else if (event.keyCode == DOM_VK_RIGHT) {
    delta = 5;
  }
  else if (event.keyCode == DOM_VK_HOME) {
    delta = -( valueNow - valueMin );
  }
  else if (event.keyCode == DOM_VK_END) {
    delta = valueMax - valueNow
  }
  else {
    return true; // Browser can still use event
  }
  
  valueNow += delta;
  if (valueNow < valueMin) {
    valueNow = valueMin;
  }
  if (valueNow > valueMax) {
    valueNow = valueMax;
  }  
  setAttrNS(slider, NS_STATE, "valuenow", valueNow);  
}
