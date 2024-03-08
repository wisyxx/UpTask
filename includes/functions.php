<?php

function debug($var) : string {
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    exit;
}

// Escape HTML | s = sanitized
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

// user authenticated
function isAuth() : void {
    if(!isset($_SESSION['login'])) {
        header('Location: /');
    }
}