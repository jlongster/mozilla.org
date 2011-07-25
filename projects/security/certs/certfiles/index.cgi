
<HTML>
<HEAD>
<TITLE>NetLock Certificate Authority (CA) - Download of certificate</TITLE>
</HEAD>
<style type="text/css">
<!--
a.info {text-decoration: none;
	color: #000000;}
a.crl {text-decoration: none;
	color: #990033;}
a:hover {color:red;}
// -->
</style>
<BODY BGCOLOR=#FFFFFF TEXT=#000000 LINK=#000000 vlink=#000000>
<center>
<table width=750>
	<tr>
		<td bgcolor=#000000 valign=middle width=100%>
			<table width=100% cellpadding=2 cellspacing=0 BORDER=0><tr><td width=50%><font color=white face="Helvetica,Arial,sans-serif" size=+1><b>NET</b>LOCK</td>
			<td width=50% align=right><img src=/pic/klogo.gif></td><tr></table>
		</td>
<tr>
<td>
<center>
<br>
<font face="sans-serif"><b>NetLock Kozjegyzoi (Class A) Tanusitvanykiado - Downloading of certificate</b></font>
<p align=justify>It is a Certificate Authority providing the highest security. The authentications are supported by notary documents and
	declarations. This certificate is recommended for high risk transactions, financial orders and their verification as well as entering into certain contracts.</p>
	<p><em>MD5 hash: </em><font size=-2>86:38:6D:5E:49:63:6C:85:5C:DB:6D:DC:94:B7:D0:F7</font><br>
	<em>SHA-1 hash: </em><font size=-2>ACED 5F65 53FD 25CE 015F 1F7A 483B 6A74 9F61 78C6</font></p>
<form action=index.cgi method=post>
	<input type=hidden name=lang value=EN>

	<input type=hidden name=raw>
	<input type=hidden name=ca value=kozjegyzoi>
	<input type=hidden name=tem value=ANONYMOUS/kulcsjegyzok/tanusit_letoltes.tem>
	<font size=-1><input type=submit value="Certificate Authority certificate">&nbsp;
	<select name=typ>
		<option value=browser select>import</option>
		<option value=txtpem>view</option>
		<option value=file>save</option>
	</select>
</form>
<form action=index.cgi method=post>
	<input type=hidden name=lang value=EN>

	<input type=hidden name=tem value=ANONYMOUS/kulcsjegyzok/crl_letoltes.tem>
	<input type=hidden name=crl value=kozjegyzoi>
	<input type=hidden name=raw>
	<p><font size=-1><input type=submit value="Revocation list (CRL)">&nbsp; 
	<select name=typ>

		<option value=txtpem>view</option>
		<option value=file>save</option>
	</select>
</form>
<p align=left><a href="javascript:void(window.history.back())"><font size=-1 face="sans-serif" color=#990033><<< Back to previous page</font></a></p>
</td></tr></table>
</center>
</BODY>
</HTML>