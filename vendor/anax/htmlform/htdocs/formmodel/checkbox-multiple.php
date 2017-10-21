<?php
include("../incl/config.php");

$title = "Checkbox with multiple choices";
$form = new \Anax\HTMLForm\FormModelCheckboxMultiple($di);
$form->check();

include("../incl/renderPage.php");
