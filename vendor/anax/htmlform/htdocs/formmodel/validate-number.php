<?php
include("../incl/config.php");

$title = "Validate number";
$form = new \Anax\HTMLForm\FormModelValidateNumber($di);
$form->check();

include("../incl/renderPage.php");
