<?php
if (getenv('JAWSDB_URL')) {
    $url = parse_url(getenv('JAWSDB_URL'));

    $host = $url["host"];
    $dbname = substr($url["path"], 1);
    $username = $url["user"];
    $password = $url["pass"];

    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} else {
    $db = new PDO('mysql:host=localhost;dbname=exercici1', 'root', '');
}

// Load the SQL file
$sql = file_get_contents('exercici1.sql');

// Execute the SQL file
$stmt = $db->prepare($sql);
$stmt->execute();

echo "Database initialized!";
?>
