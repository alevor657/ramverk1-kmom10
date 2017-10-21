<?php
include("../incl/config.php");

$title = "Using checkboxes";
$form = new \Anax\HTMLForm\FormModelCheckbox($di);
$form->check();

include("../incl/renderPage.php");
