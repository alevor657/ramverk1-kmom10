<?php
include("../incl/config.php");

$title = "Form elements HTML 4.01 and HTML5";
$form = new \Anax\HTMLForm\FormModelElementsAll($di);
$form->check();

include("../incl/renderPage.php");
