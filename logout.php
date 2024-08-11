<?php
/**
 * Created by PhpStorm.
 * User: Marta
 * Date: 13/03/2017
 * Time: 0:25
 */

unset($_COOKIE['user']);
setcookie('user', '', time() - 3600);

header("Location: index.php");