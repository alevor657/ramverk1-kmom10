<?php
function esc($var)
{
    return htmlentities($var);
}

/**
 * @SuppressWarnings("PHPMD")
 */
function debug($var)
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    exit;
}
