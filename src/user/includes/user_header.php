<?php

  ob_start();
  error_reporting(E_ALL);
  ini_set("display_errors", 1);
  include_once('../includes/db.php');
  include_once("../functions.php");
  session_start();
  $userId = $_SESSION['userId'];
  $user = getSingleUser($userId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Raleway:500,600,700|Roboto|Comfortaa:400,700" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/main.css">
    <title>Traveling Coders</title>
</head>
<body>
    <?php include '../includes/navigation.php'; ?>
    <div class="container_fluid">
        <div class="user-wrapper">
            <aside class="col-md-2 user-aside">
                <div class="user-info">
                    <div class="user-name">
                        <a href="../index?p=avatar"><img src="../assets/img/73.jpg" alt=""></a>
                        <h1><?php echo $user['user_name_first']." ".$user['user_name_last']; ?></h1>
                        <p class="title"><?php echo $user['user_title'] ?></p>
                    </div>
                    <nav>
                        <ul>
                            <li><a href="/user/?p=blogs"><i class="fa fa-sticky-note-o"></i> Blogs</a></li>
                            <li><a href="/user/?p=comments"><i class="fa fa-comment"></i> Comments</a></li>
                            <li><a href="/user/?p=threads"><i class="fa fa-newspaper-o"></i> Threads</a></li>
                            <li><a href="/user/?p=messages"><i class="fa fa-envelope" aria-hidden="true"></i> Messages</a></li>
                            <li><a href=""><i class="fa fa-th" aria-hidden="true"></i> Settings</a></li>
                        </ul>
                    </nav>
                </div>
            </aside>
            <section class="col-md-10">