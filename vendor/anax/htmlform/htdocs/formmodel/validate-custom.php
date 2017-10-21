<?php
include("../incl/config.php");

$title = "Custom validation";
$form = new \Anax\HTMLForm\FormModelValidateCustom($di);
$form->check();

include("../incl/renderPage.php");
