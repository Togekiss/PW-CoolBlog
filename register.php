<?php
/**
 * Created by PhpStorm.
 * User: Marta
 * Date: 12/03/2017
 * Time: 22:29
 */
require 'db_connect.php';

function usernameOk($username) {
    $pattern = "~[A-Za-z0-9]+~";
    return (strlen($username) <= 20 && preg_match($pattern, $username));
}
function birthdateOk($birthdate) {
    return true;
}
function emailOk($email) {
    return (filter_var($email, FILTER_VALIDATE_EMAIL));
}

function passwordOk($password, $confirm_password) {
    $pattern = "~^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9]{6,}$~";
    return ((strlen($password) >= 6) && (strlen($password) <= 12) && preg_match($pattern, $password) && ($password === $confirm_password));
}


if (empty($_POST)) {
    header("Location: ../register.html");
    exit;
}


if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['birthdate']) || empty($_POST['password']) || empty($_POST['confirm_password'])) {
    header("Location: ../register.html");
    exit;
}

$username = $_POST['username'];
$email = $_POST['email'];
$birthdate = $_POST['birthdate'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if (usernameOk($username) && emailOk($email) && birthdateOk($birthdate) && passwordOk($password, $confirm_password)) {

    //$db = new PDO('mysql:host=localhost;dbname=exercici1','root','');
    $statement = $db->prepare("INSERT INTO user (username, email, birthdate, password) VALUES (?, ?, ?, ?)");

    $statement->bindParam(1, $username, PDO::PARAM_STR);
    $statement->bindParam(2, $email, PDO::PARAM_STR);
    $statement->bindParam(3, $birthdate, PDO::PARAM_STR);
    $statement->bindParam(4, $password, PDO::PARAM_STR);
    $statement->execute();

    header("Location: login.html");
}
else {
        header("Location: register.html");
        exit;
}