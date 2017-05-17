<?php
  ob_start();
  error_reporting(E_ALL);
  ini_set("display_errors", 1);
  include_once('db.php');
  include_once("functions.php");
  session_start();
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
