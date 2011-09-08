<?php

/*
 * In a separate file because mozilla.org does not use output buffering so
 * any redirects have to happen before output.
 */

require_once "{$config['file_root']}/includes/forms/ContributeForm.php";

$form = new ContributeForm($_POST);
$form->process();
$error = $form->getError();

?>
