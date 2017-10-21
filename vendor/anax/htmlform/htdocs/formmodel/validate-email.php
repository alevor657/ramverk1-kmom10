<?php
include("../incl/config.php");

$title = "Validate email";
$form = new \Anax\HTMLForm\FormModelValidateMail($di);
$form->check();

include("../incl/renderPage.php");
