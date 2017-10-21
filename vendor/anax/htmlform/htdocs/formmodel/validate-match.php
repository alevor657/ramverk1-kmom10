<?php
include("../incl/config.php");

$title = "Password matches, validate using 'match'";
$form = new \Anax\HTMLForm\FormModelValidateMatch($di);
$form->check();

include("../incl/renderPage.php");
