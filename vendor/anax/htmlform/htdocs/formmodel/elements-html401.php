<?php
include("../incl/config.php");

$title = "Form elements as of HTML 4.01";
$form = new \Anax\HTMLForm\FormModelElementsHTML401($di);
$form->check();

include("../incl/renderPage.php");
