<?php

function check_query($result) {
    global $connection;
    if(!$result) {
        die("Query Failed: " . mysqli_error($connection));
    }
}

function getIdByName($table, $column, $str) {
    global $connection;
    $query = "SELECT category_id FROM {$table} WHERE {$column}='{$str}'";
    $result = mysqli_query($connection, $query);
    check_query($result);
    return $result;
}

function getCatNameById($table, $column, $id) {
    global $connection;
    $query = "SELECT category_name FROM {$table} WHERE {$column}='{$id}'";
    $result = mysqli_query($connection, $query);
    check_query($result);
    return $result;
}

function getById($str, $column, $id) {
    global $connection;
    $query = "SELECT * FROM {$str} WHERE {$column}={$id}";
    $result = mysqli_query($connection, $query);
    check_query($result);
    return $result;
}

function getByIdLength($str, $column, $id) {
    global $connection;
    $query = "SELECT * FROM {$str} WHERE {$column}={$id}";
    $result = mysqli_query($connection, $query);
    check_query($result);
    $len = mysqli_num_rows($result);
    return $len;
}

function getAll($str) {
    global $connection;
    $query = "SELECT * FROM {$str}";
    $result = mysqli_query($connection, $query);
    check_query($result);
    return $result;
}

function getIdByUsername($username) {
    global $connection;
    $query = "SELECT user_id FROM users WHERE user_username = '{$username}'";
    $result = mysqli_query($connection, $query);
    check_query($result);
    $row = mysqli_fetch_assoc($result);
    return $row['user_id'];
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}