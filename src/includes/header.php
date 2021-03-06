<?php
  ob_start();
  error_reporting(E_ALL);
  ini_set("display_errors", 1);
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
  date_default_timezone_set('UTC');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Raleway:500,600,700|Roboto|Comfortaa:400,700" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>Traveling Coders</title>
</head>
<body>
<?php include 'includes/navigation.php'; ?>
