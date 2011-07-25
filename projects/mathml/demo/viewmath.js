/*
 * The contents of this file are subject to the Mozilla Public
 * License Version 1.1 (the"License"); you may not use this file
 * except in compliance with the License. You may obtain a copy of
 * the License at http://www.mozilla.org/MPL/
 *
 * Software distributed under the License is distributed on an"AS
 * IS" basis, WITHOUT WARRANTY OF ANY KIND, either express or
 * implied. See the License for the specific language governing
 * rights and limitations under the License.
 *
 * The Original Code is Mozilla MathML Project.
 *
 * The Initial Developer of the Original Code is The University Of
 * Queensland.  Portions created by The University Of Queensland are
 * Copyright (C) 2002 The University Of Queensland.  All Rights Reserved.
 *
 * Contributor(s):
 *   Roger B. Sidje <rbs@maths.uq.edu.au>
 *   Steve Swanson <steve.swanson@mackichan.com>
 *   
 */

var gDebug = 0;
var gLineCount = 0;
var gStartTargetLine = 0;
var gEndTargetLine = 0;
var gTargetNode = null;
var gWYSIWYGWindow = null;
// had to use an absolute path here, otherwise Mozilla is confused when the
// script is loaded from a directory different from where the CSS resides
var gViewSourceCSS = 'http://www.mozilla.org/projects/mathml/demo/viewsource.css';

function viewmath(evt) {
  evt.stopPropagation();
  gLineCount = 0;
  gStartTargetLine = 0;
  gEndTargetLine = 0;
  gTargetNode = evt.target;
  if (gTargetNode.nodeType == Node.TEXT_NODE) { // leaf text
    gTargetNode = gTargetNode.parentNode;
  }
  var m = findmathparent(evt.target);
  if (m) {
    gWYSIWYGWindow = open("", "wysiwyg", "scrollbars=1,resizable=1,width=500,height=200");
    gWYSIWYGWindow.document.open();
    with (gWYSIWYGWindow.document) {
      writeln('<html><base target="wysiwyg">');
      writeln('<head><title>MathML WYSIWYG Source</title>');
      writeln('<link rel="stylesheet" type="text/css" href="'+gViewSourceCSS+'">');
      writeln('<style>#target{border:dashed 1px; background-color:lightyellow;}</style>'); 
      writeln('<script>');
      writeln('function scrollToTarget() {');
                 // bug: self.location.hash = 'anchor'; doesn't work
      writeln('  var anchor = document.anchors["target"];');
      writeln('  scrollTo(0/*anchor.offsetLeft*/, anchor.offsetTop);');
      writeln('}');
      writeln('</script>');
      writeln('</head>');
      write('<body id="viewsource" onload="window.focus();scrollToTarget();">');
//if wrapping... write('<body id="viewsource" class="wrap" onload="window.focus();scrollToTarget();">');
      write('<pre>');
      writeln(getOuterMarkup(m,0));
      writeln('</pre></body></html>');
    }
    gWYSIWYGWindow.document.close();
  }
}

function findmathparent(node) {
  while (node && node.nodeName.indexOf("math") == -1)
    node = node.parentNode;
  return node;
}

function getInnerMarkup(n, indent) {
  var str = '';
  for (var i = 0; i<n.childNodes.length; i++)
    str += getOuterMarkup(n.childNodes.item(i),indent);
  return str;
}

function getOuterMarkup(n, indent) {
  var newline = '';
  var padding = '';
  var str = '';
  if (n == gTargetNode) {
    gStartTargetLine = gLineCount;
    str += '</pre><a name="target"></a><pre id="target">';
  }

  switch (n.nodeType) {
  case Node.ELEMENT_NODE: // Element
    // to avoid the wide gap problem, '\n' is not emitted on the first
    // line and the lines before & after the <pre id="target">...</pre>
    newline = '';
    if (gLineCount > 0) {
      newline = '\n';
    }
    if (gLineCount == gStartTargetLine ||
        gLineCount == gEndTargetLine) {
      newline = '';
    }
    gLineCount++;
    if (gDebug) {
      newline += gLineCount;
    }
    for (var k=0; k<indent; k++) {
      padding += ' ';
    }
    str += newline + padding + '&lt;<span class="start-tag">' + n.nodeName + '</span>';
    for (var i=0; i<n.attributes.length; i++) {
      var attr = n.attributes.item(i);
      if (!gDebug && attr.nodeName.match(/^-moz-math-/)) {
        continue;
      }
      str += ' <span class="attribute-name">';
      str += attr.nodeName;
      str += '</span>=<span class="attribute-value">"';
      str += unicode2entity(attr.nodeValue);
      str += '"</span>';
    }
    str += '&gt;';
    var oldLine = gLineCount;
    str += getInnerMarkup(n, indent + 2);
    if (oldLine == gLineCount) {
      newline = '';
      padding = '';
    }
    else {
      newline = '\n';
      if (gLineCount == gEndTargetLine) {
        newline = '';
      }
      gLineCount++;
      if (gDebug) {
        newline += gLineCount;
      }
    }
    str += newline + padding + '&lt;/<span class="end-tag">' + n.nodeName + '</span>&gt;';
    break;
  case Node.TEXT_NODE: // Text
    var tmp = n.nodeValue;
    tmp = tmp.toString();
    tmp = tmp.replace(/(\n|\r|\t)+/g, " ");
    tmp = tmp.replace(/\s+/," ");
    tmp = tmp.replace(/^\s+/, "");
    tmp = tmp.replace(/\s+$/,"");
    if (tmp.length != 0) {
      str += '<span class="text">' + unicode2entity(tmp) + '</span>';
    }
    break;
  default:
    break;
  }
  if (n == gTargetNode) {
    gEndTargetLine = gLineCount;
    str += '</pre><pre>';
  }
  return str;
}
