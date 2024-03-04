<?php

$db = mysqli_connect('localhost', 'root', '177068', 'uptask_mvc');


if (!$db) {
    echo "Error: Couldn't conect to MySQL.";
    echo "Error code: " . mysqli_connect_errno();
    echo "Error details: " . mysqli_connect_error();
    exit;
}
