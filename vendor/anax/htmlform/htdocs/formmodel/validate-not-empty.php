<?php
include("../incl/config.php");

$title = "Validate not empty";
$form = new \Anax\HTMLForm\FormModelValidateNotEmpty($di);
$form->check();

include("../incl/renderPage.php");
