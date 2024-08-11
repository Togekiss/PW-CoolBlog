<?php
/**
 * Created by PhpStorm.
 * User: Marta
 * Date: 12/03/2017
 * Time: 22:29
 */


if (empty($_POST)) {
    header("Location: login.html");
    exit;
}


if (empty($_POST['login']) || empty($_POST['password'])) {
    header("Location: login.html");
    exit;
}

$login = $_POST['login'];
$password = $_POST['password'];


$db = new PDO('mysql:host=localhost;dbname=exercici1','root','');
$statement = $db->prepare("SELECT id FROM user WHERE ( username=:login OR email=:login ) AND password=:password");

$statement->bindParam(':login', $login, PDO::PARAM_STR);
$statement->bindParam(':password', $password, PDO::PARAM_STR);

$statement->execute();
$results = $statement->fetch(PDO::FETCH_ASSOC);

if (empty($results)) {
    header("Location: login.html");
}
else {
    setcookie('user', $results['id'], time()+604800);
    header("Location: index.php");
}