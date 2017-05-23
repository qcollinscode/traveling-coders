<?php

    // $db['db_host'] = 'localhost';  
    // $db['db_user'] = 'root';
    // $db['db_pass'] = '';
    // $db['db_name'] = 'traveling_coders';


    $db['db_host'] = 'us-cdbr-iron-east-03.cleardb.net';  
    $db['db_user'] = 'b221ad66af70e8';
    $db['db_pass'] = '295a8efe';
    $db['db_name'] = 'heroku_0b0118ba54f5bdc';


    foreach($db as $key => $value) {
        define(strtoupper($key), $value);
    }

    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if(!$connection) {
        die('Connection Failed');
    }