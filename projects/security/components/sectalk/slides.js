// vim: set sw=2 ts=2:
// Cool js script(s) to make your presentations fly
// Gagzilla <gagzilla@nospam.yahoo.com> 07/08/01 

function rgbcolor(a,b,c) {
  return 'rgb(' + a + ',' + b + ',' + c + ')'
};

function fadecolor(rgbfrom, rgbto, step)
{
  var rgbformat = /rgb\((\d+),(\d+),(\d+)\)/g
  rgbformat.exec(rgbfrom);
  return rgbcolor(RegExp.$1, RegExp.$2, RegExp.$3 + step)
}

function flyleft(s) 
{
  alert('foo');
  s.cssRules[3].style.color = s.cssRules[3].style.backgroundColor;
  color = 255;
  fadein(color);
  dump(document.styleSheets[0].cssRules[3].style.color + '\n');
  dump(fadecolor(s.cssRules[3].style.color, 'foo', 10));
  dump(' was before = ' + s.cssRules[3].style.color);
};

function fadein(c)
{
  document.styleSheets[0].cssRules[3].style.color = rgbcolor(color, color, color);
  color= color-20;
  if (color> 0) setTimeout('fadein()', 200);
};

function foo(c)
{
  alert(c);
  alert(c.cssRules);
}

/* this function makes stuff appear out of thin air... moz-opacity really :)
*/
var objectToFade = 0;
var timeout= 1000;
function materialize(o)
{
  if (!o)  { o = objectToFade; if (!o) return;}
  else
    objectToFade = o;
  try {
    if (opacity <= 0) { o.style.MozOpacity = 0; return; }
    opacity -= 0.1;
    o.style.MozOpacity = opacity;
    setTimeout("materialize()", timeout, o);
  } catch (ex) {
    alert(ex);
  }
}

/* Hand over the document and I'll take you to the next slide :) */
function Next(d) 
{
  var re = /(\D*)(0*)(\d+)(\D*)/;
  var l = new String(d.location);
  var section = l.substr(l.lastIndexOf('/'));
  var n = section.replace(re, '$3');
  var z = RegExp.$2;
  if ((new String(++n)).length > RegExp.$3.length) 
    z = z.substr(1);
  l = l.substr(0, l.lastIndexOf('/')) + RegExp.$1 + z + n + RegExp.$4;
  d.location = l;
}

/* Hand over the document and I'll take you to the prev slide :) */
function Prev(d) 
{
  var re = /(\D*)(0*)(\d+)(\D*)/;
  var l = new String(d.location); 
  var section = l.substr(l.lastIndexOf('/'));
  var n = section.replace(re, '$3');
  var z = RegExp.$2;
  --n;
  // if you plan to number your slides 01, 02... 09, 10 then uncomment these
  //if((new String(n)).length < RegExp.$3.length) 
    //z +='0';
  l = l.substr(0,l.lastIndexOf('/')) + RegExp.$1 + z + n + RegExp.$4;
  d.location = l;
}

function All(d)
{
  d.location = "all.xml";
}
function Slide16(d)
{
  d.location = "slide16.xml";
}

// hack 
window.addEventListener("load", SlideLoad, false);

var opacity = 1.0;
function SlideLoad() 
{
  return;
  try {
    var a = document.getElementById("fadedmoz");
    if (a) {
      //timeout = 6000*a.timeout;
      materialize(a);
    }
  }
  catch (ex) {
    alert(ex);
  }
}
