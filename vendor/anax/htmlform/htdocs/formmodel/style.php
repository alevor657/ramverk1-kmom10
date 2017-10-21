<?php
include("../incl/config.php");

$title = "Style the form";
$form = new \Anax\HTMLForm\FormModelStyle($di);
$form->check();

include("../incl/renderPage.php");
