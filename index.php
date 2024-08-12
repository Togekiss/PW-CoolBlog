<?php
require 'db_connect.php';

    //$db = new PDO('mysql:host=localhost;dbname=exercici1','root','');
    $statement = $db->prepare("SELECT username FROM user WHERE id = ?");
    $statement->bindParam(1, $_COOKIE['user'], PDO::PARAM_INT);
    $statement->execute();
    $user = ($statement->fetch(PDO::FETCH_ASSOC));

    if (empty($user)) {
        unset($_COOKIE['user']);
        setcookie('user', '', time() - 3600);
    }
    else $user = $user['username'];


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Practica de Projectes Web II">
    <meta name="author" content="Marta Zapatero">

    <title>Cool Blog</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="css/clean-blog.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-default navbar-custom navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="index.php">Cool Blog</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="index.php">Home</a>
                </li>
                    <?php

                        if (isset($_COOKIE['user'])) {
                            $button = "<li><a href=\"postpage.php\">Post</a></li><li><a href=\"user.php\">$user</a></li><li><a href=\"logout.php\">Log out</a></li>";
                        }
                        else {
                            $button = "<li><a href=\"login.html\">Post</a></li><li><a href=\"login.html\">Log in</a></li>";
                        }

                        echo $button;
                    ?>

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- Page Header -->
<!-- Set your background image for this header on the line below. -->
<header class="intro-header" style="background-image: url('img/home-bg.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="site-heading">
                    <h1>Cool Blog</h1>
                    <hr class="small">
                    <span class="subheading">A blog by Marta Zapatero</span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">

            <?php

            $statement = $db->prepare("SELECT * FROM entry ORDER BY created_at DESC LIMIT 10");
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            if (empty($results)) {
                $text = "<div class=\"post-preview\">
                <a href=\"\" class=\"disabled\">
                    <h2 class=\"post-title\">
                        There are no entries!
                    </h2>
            </div>";
                echo $text;
            }
            else {

                foreach ($results as $entry) {

                    $title = htmlentities($entry['title']);
                    $content = htmlentities($entry['content']);
                    $date = $entry['created_at'];

                    $text = "<div class=\"post-preview\">
                <a href=\"\" class=\"disabled\">
                    <h2 class=\"post-title\">
                        $title
                    </h2>
                    <h3 class=\"post-subtitle\">
                        $content
                    </h3>
                </a>
                <p class=\"post-meta\">Posted by $user on $date</p>
            </div>
            <hr>";

                    echo $text;
                }

            }


            ?>

        </div>
    </div>
</div>

<hr>

<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <p class="copyright text-muted">Copyright &copy; Marta Zapatero 2017</p>
            </div>
        </div>
    </div>
</footer>

<!-- jQuery -->
<script src="vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Theme JavaScript -->
<script src="js/clean-blog.min.js"></script>


</body>

</html>
