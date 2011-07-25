* {
    margin: 0;
    padding: 0;
    
    -webkit-box-sizing: border-box;
       -moz-box-sizing: border-box;
         -o-box-sizing: border-box;
            box-sizing: border-box;
}

body {
    font-family: "Georgia", Times New Roman, Times, serif;
    background: url("<?php echo data_url(dirname(__FILE__).'/../../img/tb5/page-background.png','image/png'); ?>") repeat-x scroll 50% 0 #FFFFFF;
    overflow-y: scroll;
    line-height: 24px;
    font-size: 14px;
    color: #222;
    
}

p {
    font-size: 16px;
    color: #222;
    margin: 0 0 7px 0;
    text-align: justify;
}

a {
    color: #0A4E96;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

.column1,
.column2 {
    display: inline-block;
    float: left;
    min-height: 1%;
    position: relative;
}

.column1 {
    width: 180px;
    background-image: url('<?php echo data_url(dirname(__FILE__).'/../../img/tb5/whatsnew/logo.png','image/png'); ?>');
    height: 286px;
    padding: 0 10px;
}

.column2 {
    width: 540px;
    padding: 0 40px;
    background-color: #fff;
    background-image: url('<?php echo data_url(dirname(__FILE__).'/../../img/tb5/whatsnew/border.png','image/png'); ?>');
    background-repeat: no-repeat;
}

h1 {
    font-size: 24px;
    font-weight: normal;
    font-style: italic;
    margin: 0 0 21px 0;
}

h2 {
    font-size: 16px;
    font-weight: normal;
    color: #0A4E96;
}

#wrapper {
    width: 720px;
    margin: 0 auto;
}

#header {
    margin: 20px 0 0 180px;
    padding: 40px 20px 20px 40px;
    width: 540px;
    color: grey;
    font-size: 18px;
    font-family: 'Georgia', arial, serif;
    font-style: italic;
    background-color: #fff;
    border-radius: 5px 5px 0 0;
}

#header,
#content,
#footer {
    display: block;
    float: left;
}

#header .thanks {
    font-size: 24px;
    font-family: 'Georgia', arial, serif;
    -webkit-transform: rotate(10deg); 
       -moz-transform: rotate(10deg);
         -o-transform: rotate(10deg);
            transform: rotate(10deg);
}

#header .thanks,
.contentFooter .signature {
    color: #444;
    text-shadow: 1px 1px 0 #fff;
}

.contentHeader,
.contentBody {
    margin: 0 0 21px 0;
}

.contentBody {
    overflow: hidden;
    border-radius: 5px;
}

.contentBody .toggle {
    padding: 5px 10px;
    text-shadow: 1px 1px 0 #fff;
    background-color: #f2f2f2;
    background-image: -moz-linear-gradient(top,#fff 0%,#f2f2f2 100%);
    border-width: 1px;
    border-color: #e6e6e6 #ccc #ccc #e6e6e6;
    border-style: solid;
    cursor: pointer;
    position: relative;
    z-index: 100;
    
    -webkit-border-radius: 5px;
       -moz-border-radius: 5px;
         -o-border-radius: 5px;
            border-radius: 5px;
    
    -webkit-transition: -webkit-border-radius 1s 0.4s cubic-bezier(0, 0, 0, 1);
       -moz-transition:    -moz-border-radius 1s 0.4s cubic-bezier(0, 0, 0, 1);
         -o-transition:      -o-border-radius 1s 0.4s cubic-bezier(0, 0, 0, 1);
            transition:         border-radius 1s 0.4s cubic-bezier(0, 0, 0, 1);
}
    
.contentBody .plus img {
    vertical-align: middle;
    
    -webkit-transform: rotate(0deg);
       -moz-transform: rotate(0deg);
         -o-transform: rotate(0deg);
            transform: rotate(0deg);
    
    -webkit-transition: -webkit-transform 0.8s cubic-bezier(0, 0, 0, 1);
       -moz-transition:    -moz-transform 0.8s cubic-bezier(0, 0, 0, 1);
         -o-transition:      -o-transform 0.8s cubic-bezier(0, 0, 0, 1);
            transition:         transform 0.8s cubic-bezier(0, 0, 0, 1);
}

.contentBody.open .plus img {
    -webkit-transform: rotate(135deg);
       -moz-transform: rotate(135deg);
         -o-transform: rotate(135deg);
            transform: rotate(135deg);
}

.contentBody.open .toggle {
    -webkit-border-radius: 5px 5px 0 0;
       -moz-border-radius: 5px 5px 0 0;
         -o-border-radius: 5px 5px 0 0;
            border-radius: 5px 5px 0 0;
    
    -webkit-transition: -webkit-border-radius 0s cubic-bezier(0, 0, 0, 1);
       -moz-transition:    -moz-border-radius 0s cubic-bezier(0, 0, 0, 1);
         -o-transition:      -o-border-radius 0s cubic-bezier(0, 0, 0, 1);
            transition:         border-radius 0s cubic-bezier(0, 0, 0, 1);
}

.contentBody ul {
    list-style-type: none;
    border-width: 0 1px 1px 1px;
    border-color: #ccc;
    border-style: solid;
    
    
    -webkit-border-radius: 0 0 5px 5px;
       -moz-border-radius: 0 0 5px 5px;
         -o-border-radius: 0 0 5px 5px;
            border-radius: 0 0 5px 5px;
}

.contentBody ul li {
    padding: 10px;
    color: #444;
    border-bottom: 1px solid #e6e6e6;
}

.contentBody ul li:nth-child(even) {
    background-color: #fafafa;
}

.contentBody ul li:last-child {
    border-bottom: none;
}

.contentFooter {
    margin: 60px 0 0 0;
}

.contentFooter .signature {
    font-size: 18px;
    font-style: italic;
    font-family: 'Georgia', arial, serif;
}

#footer {
    width: 540px;
    margin: 0 0 0 180px;
    padding: 40px;
    color: #2E93FF;
    text-align: center;
}

#footer ul {
    list-style-type: none;
}

#footer ul li {
    display: inline-block;
    margin: 0 0 0 10px;
}


/* START hbox/vbox normalization from http://alex.dojotoolkit.org/2009/08/css-3-progress/ */
/* hbox and vbox classes */
 
.hbox {
	display: -webkit-box;
	-webkit-box-orient: horizontal;
	-webkit-box-align: stretch;
 
	display: -moz-box;
	-moz-box-orient: horizontal;
	-moz-box-align: stretch;
 
	display: box;
	box-orient: horizontal;
	box-align: stretch;
	
	width: 100%;
}
 
.hbox > * {
	-webkit-box-flex: 0;
	-moz-box-flex: 0;
	box-flex: 0;
	display: block;
}
 
.vbox {
	display: -webkit-box;
	-webkit-box-orient: vertical;
	-webkit-box-align: stretch;
 
	display: -moz-box;
	-moz-box-orient: vertical;
	-moz-box-align: stretch;
 
	display: box;
	box-orient: vertical;
	box-align: stretch;
}
 
.vbox > * {
	-webkit-box-flex: 0;
	-moz-box-flex: 0;
	box-flex: 0;
	display: block;
}
 
.spacer {
	-webkit-box-flex: 1;
	-moz-box-flex: 1;
	box-flex: 1;
}
 
.reverse {
	-webkit-box-direction: reverse;
	-moz-box-direction: reverse;
	box-direction: reverse;
}
 
.boxFlex0 {
	-webkit-box-flex: 0;
	-moz-box-flex: 0;
	box-flex: 0;
}
 
.boxFlex1, .boxFlex {
	-webkit-box-flex: 1;
	-moz-box-flex: 1;
	box-flex: 1;
}
 
.boxFlex2 {
	-webkit-box-flex: 2;
	-moz-box-flex: 2;
	box-flex: 2;
}
 
.boxGroup1 {
	-webkit-box-flex-group: 1;
	-moz-box-flex-group: 1;
	box-flex-group: 1;
}
 
.boxGroup2 {
	-webkit-box-flex-group: 2;
	-moz-box-flex-group: 2;
	box-flex-group: 2;
}
 
.start {
	-webkit-box-pack: start;
	-moz-box-pack: start;
	box-pack: start;
}
 
.end {
	-webkit-box-pack: end;
	-moz-box-pack: end;
	box-pack: end;
}
 
.center {
	-webkit-box-pack: center;
	-moz-box-pack: center;
	box-pack: center;
}
/* END hbox/vbox normalization from http://alex.dojotoolkit.org/2009/08/css-3-progress/ */

/* clearfix */

.clearfix:after {
	content: ".";
	display: block;
	clear: both;
	visibility: hidden;
	line-height: 0;
	height: 0;
}

html[xmlns] .clearfix {
	display: block;
}

* html .clearfix {
	height: 1%;
}

.rtl {
    direction: rtl;
}
