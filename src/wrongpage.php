<?php

    $varr = $_GET['p'];
    $varr = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($varr)); 
    echo $varr;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <section class="wrongpage">
        <h1>Wrong Page!</h1>
    </section>
</body>
</html>