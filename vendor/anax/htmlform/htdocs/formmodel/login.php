<?php
include("../incl/config.php");

$title = "Login";
$form = new \Anax\HTMLForm\FormModelLogin($di);
$form->check();

include("../incl/renderPage.php");
