<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Mozilla XML Namespace</title>

	<style type="text/css">
		body {
			font-family: sans-serif;
			font-size: 16px;
		}

		h1 {
			margin: 0em;
			padding: 0em;
			font-size: 2em;
			line-height: 150%;
		}

		h2 {
			margin: 0em;
			padding: 0em;
			font-size: 1.5em;
			line-height: 150%;
			font-style: italic;
		}

		dt {
			font-weight: bolder;
		}

		dd + dt {
			margin-top: 0.75em;
		}
	</style>
</head>
<body>
	<section>
		<h1>Mozilla XML Namespace</h1>
<?php

$namespaces = array(
	'addons-bl'	=>	array(
		'namespace'	=>	'http://www.mozilla.org/2006/addons-blocklist',
		'standard'	=>	'Add-ons Blocklist',
		'docs'		=>	'https://wiki.mozilla.org/Extension_Blocklisting:Code_Design',
	),
	'em-rdf'	=>	array(
		'namespace'	=>	'http://www.mozilla.org/2004/em-rdf',
		'standard'	=>	'Extension Manifest',
		'docs'		=>	'https://developer.mozilla.org/en/Install_Manifests',
	),
	'microsummaries'	=>	array(
		'namespace'	=>	'http://www.mozilla.org/microsummaries/0.1',
		'standard'	=>	'Microsummaries',
		'docs'		=>	'https://developer.mozilla.org/en/Microsummary_XML_grammar_reference',
	),
	'mozsearch'	=>	array(
		'namespace'	=>	'http://www.mozilla.org/2006/browser/search/',
		'standard'	=>	'MozSearch plugin format',
		'docs'		=>	'https://developer.mozilla.org/en/Creating_MozSearch_plugins',
	),
	'update'	=>	array(
		'namespace'	=>	'http://www.mozilla.org/2005/app-update',
		'standard'	=>	'Software Update Service',
		'docs'		=>	'https://wiki.mozilla.org/Software_Update:Testing',
	),
	'xbl'	=>	array(
		'namespace'	=>	'http://www.mozilla.org/xbl',
		'standard'	=>	'XML Binding Language (XBL)',
		'docs'		=>	'https://developer.mozilla.org/en/XBL',
	),
	'xforms-type'	=>	array(
		'namespace'	=>	'http://www.mozilla.org/projects/xforms/2005/type',
		'standard'	=>	'XForms mozType extension',
		'docs'		=>	'https://developer.mozilla.org/en/XForms/Custom_Controls',
	),
	'xul'	=>	array(
		'namespace'	=>	'http://www.mozilla.org/keymaster/gatekeeper/there.is.only.xul',
		'standard'	=>	'XML User Interface Language (XUL)',
		'docs'		=>	'https://developer.mozilla.org/en/XUL',
	),
);

$ns_id = ( isset( $_GET['id'] ) ) ? $_GET['id'] : '';
$namespace = ( isset( $namespaces[$ns_id] ) ) ? $namespaces[$ns_id] : FALSE;

if( $namespace )
{
?>
		<h2><?= $namespace['standard'] ?></h2>
		<dl>
			<dt>Namespace</dt>
			<dd><code><?= $namespace['namespace'] ?></code></dd>
			<dt>Documentation</dt>
			<dd><a href="<?= $namespace['docs'] ?>"><?= $namespace['docs'] ?></a></dd>
		</dl>
<?php

	if( $ns_id == 'xul' )
	{
?>
		<p style="width: 100%; font-family: fantasy; font-variant: small-caps; font-weight: bold; font-size: xx-large; text-align: center;">There is no data.<br />There is only XUL!</p>
<?php
	}
}
else
{
?>
		<p><strong>ERROR:</strong> No namespace selected!</p>
<?php
}

?>
	</section>
</body>
</html>