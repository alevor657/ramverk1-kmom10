<?php
include("../incl/config.php");

$title = "Select option with multiple choices";
$form = new \Anax\HTMLForm\FormModelSelectOptionMultiple($di);
$form->check();

include("../incl/renderPage.php");
