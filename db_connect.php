<?php
// db_connect.php

if (getenv('JAWSDB_URL')) {
    // Heroku environment
    $url = parse_url(getenv('JAWSDB_URL'));

    $host = $url["host"];
    $dbname = substr($url["path"], 1);
    $username = $url["user"];
    $password = $url["pass"];

    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} else {
    // Local environment
    $db = new PDO('mysql:host=localhost;dbname=exercici1', 'root', '');
}

// Set the PDO error mode to exception
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
