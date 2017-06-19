<?php
    include_once('includes/db.php');
    include_once('includes/objects/Blogs.php');
    include_once('includes/objects/Boards.php');
    include_once('includes/objects/Categories.php');
    include_once('includes/objects/Comments.php');
    include_once('includes/objects/Favorites.php');
    include_once('includes/objects/Threads.php');
    include_once('includes/objects/Users.php');
    include_once("functions.php");
    if(!isset($_SESSION)) {
        session_start();
    }

    $favoritesObj = new Favorites($connection);
    $favoritesObj->set_user($_SESSION['userId']);
    $favoritesObj->set_blog($_GET['p']);
    $favoritesObj->add_favorite();