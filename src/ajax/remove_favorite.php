<?php
    include_once('includes/db.php');
    include_once('includes/objects.php');
    include_once("functions.php");
    if(!isset($_SESSION)) {
        session_start();
    }

    $favoritesObj = new Favorites($connection);
    $favoritesObj->set_user($_SESSION['userId']);
    $favoritesObj->set_blog($_GET['p']);
    $favoritesObj->remove_favorite();