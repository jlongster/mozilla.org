/* -*- Mode: Java; tab-width: 4; indent-tabs-mode: nil; c-basic-offset: 4 -*-
 *
 * The contents of this file are subject to the Netscape Public
 * License Version 1.1 (the "License"); you may not use this file
 * except in compliance with the License. You may obtain a copy of
 * the License at http://www.mozilla.org/NPL/
 *
 * Software distributed under the License is distributed on an "AS
 * IS" basis, WITHOUT WARRANTY OF ANY KIND, either express or
 * implied. See the License for the specific language governing
 * rights and limitations under the License.
 *
 * The Original Code is mozilla.org code.
 *
 * The Initial Developer of the Original Code is Netscape
 * Communications Corporation.  Portions created by Netscape are
 * Copyright (C) 1998 Netscape Communications Corporation. All
 * Rights Reserved.
 *
 * Contributor(s): John Taylor, Gérard Talbot
 */

//Checks for correct version of browser. Provides error message.
var msg = "This application is meant for browsers having a basic support for javascript and DOM. It will not run on old browsers."
msg += "<br><br>Please <a href=\"http:\/\/www.mozilla.com\/firefox\/\">download the latest Firefox version</a>.";

if(!document.getElementById && document.write) 
{
document.write(msg);
} 

else if(document.getElementById && document.writeln)
{
    document.writeln("<h1>Mozilla Security Configurator<\/h1>");

    document.writeln("<address class=\"author\"><a href=\"mailto:jtaylor@netscape.com\">John Taylor<\/a><\/address>");

    document.writeln("<h2>About<\/h2>");

    document.writeln("<p>The Mozilla Security Configurator is a web-based application providing Mozilla users an easy method of configurating security privileges. Currently, the configurator allows users to modify the privileges associated with <a href=\"terms.html#cert\">certificates<\/a> that sites have stored on their computer. Certificates verify JavaScript code, allowing users to grant a site <a href=\"terms.html#priv\">privileges<\/a> so it can modify the user\'s browser or preferences. This application provides users an interface to change the privileges granted to those certificates.<\/p>");

    document.writeln("<h2>Instructions<\/h2>");

    document.writeln("<p>To start the security configurator, follow the link below. For quick access, bookmark the link. The first time you run the configurator, you will see a dialog box asking for you to accept our certificate. You will need to click <b><tt>\"OK\"<\/tt><\/b> and check the <b><tt>\"Remember this decision\"<\/tt><\/b> box in order for application to work correctly and save your decisions to your preferences file.<\/p>");

    document.writeln("<p>When the application loads, three columns of data will be displayed, <tt><strong>Certificate<\/strong><\/tt>, <tt><strong>Privilege<\/strong><\/tt> and <tt><strong>Access<\/strong><\/tt>. <tt>Certificate<\/tt> displays the name of the site which owns the certificate, <tt>Privilege<\/tt> shows which <a href=\"terms.html#priv\">privileges<\/a> the site has asked for and <tt>Access<\/tt> describes if the user has granted or denied that privilege. To make changes, change the menu in the <tt>access<\/tt> column of a privilege to <tt>Granted<\/tt>, <tt>Denied<\/tt> or <tt>Ask Me<\/tt>. <strong><tt>Granted<\/tt><\/strong> access will give a site signed by the certificate a the respective privilege with out prompting the user. <b><tt>Denied<\/tt><\/b> will deny the respective privilege. <b><tt>Ask Me<\/tt><\/b> will delete the privilege from the registry. Thus, when a site running that certificate requests that privilege, it will display a dialog warning the user. To save the changes locally, click the <strong><tt>Commit<\/tt><\/strong> button.<\/p>");

    document.writeln("<p>Users can also manually add access specifications for a new privilege. To do this, enter the privilege name in the appropriate text field and click <tt><strong>Add Privilege<\/strong><\/tt>. Again, clicking <tt>Commit<\/tt> is required to save changes locally.<\/p>");

    document.writeln("<h2>Run<\/h2>");

    document.writeln("<p><a href=\"jar:http:\/\/www.mozilla.org\/projects\/security\/components\/secureapp.jar!\/getprefs.html\">"
                   + "Start the Security Configurator<\/a><\/p>");

/*
URL is no longer valid.
document.write("<p><a href=\"http://www.mozilla.org/projects/securitycomponents/forjar/getprefs.html\">"
                   +"Start the Security Configurator (codebase)</a></p>"); 
*/

    document.writeln("<table cellspacing=\"0\" cellpadding=\"4\">\n<tbody>\n<tr style=\"background-color: #F5F5DC; color: inherit;\">\n\t<td><a rel=\"up\" href=\"..\/\">Security projects<\/a><\/td>\n\t<td>&gt;<\/td>\n\t<td><a rel=\"contents\" href=\".\/\">Component Security<\/a><\/td>\n\t<td>&gt;<\/td>\n\t<td>JavaScript Security: Security Configurator<\/td>\n<\/tr>\n<\/tbody>\n<\/table>");
}