<?php
$img1 = '<img id="tblogo" src="' . data_url(dirname(__FILE__).'/../../img/tb5/start/tb-logo.png','image/png') . '">';
$img2 = '<img src="' . data_url(dirname(__FILE__).'/../../img/tb5/start/divider.png','image/png') . '">';
?>

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
#tblogo,
.tblogo {
    position: absolute;
    left: 670px;
    top: 45px;
    z-index: 1
}
p {
    font-size: 14px;
    margin: 0 0 15px 0;
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
    font-size: 36px;
    font-weight: normal;
    font-style: italic;
    margin: 0 0 21px 0;
}

h2 {
    font-size: 20px;
    font-weight: normal;
    width: 80%;
}

#wrapper {
    width: 720px;
}

#header {
    margin: 20px 0 0 180px;
    padding: 40px 20px 20px;
    width: 540px;
    background-color: #fff;
    border-radius: 5px 5px 0 0;
    text-align: right;
}

#header,
#content,
#footer {
    display: block;
    float: left;
}

.column2 img {
    margin-left: -35px;
    margin-top: 10px;
}

.contentHeader,
.contentBody {
    margin: 0 0 21px 0;
}

.contentBody {
    overflow: hidden;
    border-radius: 5px;
    color: grey;
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
    margin: 0 0 15px 15px;
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
