<?php
/**
 * Created by PhpStorm.
 * User: Marta
 * Date: 13/03/2017
 * Time: 0:35
 */

if (empty($_POST)) {
    header("Location: postpage.php");
    exit;
}


if (empty($_POST['title']) || empty($_POST['content'])) {
    header("Location: postpage.php");
    exit;
}

$title = $_POST['title'];
$content = $_POST['content'];
$user = $_COOKIE['user'];

$db = new PDO('mysql:host=localhost;dbname=exercici1','root','');
$statement = $db->prepare("INSERT INTO entry (user_id, title, content, created_at) VALUES (?, ?, ?, ?)");

$statement->bindParam(1, $user, PDO::PARAM_INT);
$statement->bindParam(2, $title, PDO::PARAM_STR);
$statement->bindParam(3, $content, PDO::PARAM_STR);
$statement->bindParam(4, date("Y-m-d H:i:s"), PDO::PARAM_STR);
$statement->execute();

header("Location: index.php");

?>