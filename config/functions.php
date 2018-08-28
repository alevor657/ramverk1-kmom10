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

function debug_noexit($var)
{
    echo "<pre>";
    var_dump($var);
    echo "===============================";
    echo "</pre>";
    // exit;
}
