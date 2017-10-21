<?php
include("../incl/config.php");

$title = "Select option list";
$form = new \Anax\HTMLForm\FormModelSelectOption($di);
$form->check();

include("../incl/renderPage.php");
