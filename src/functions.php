<?php
include_once "includes/db.php";

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

function getAllThreadsByUser($id) {
    global $connection;
    $query = "SELECT * FROM threads WHERE user_id={$id}";
    $result = mysqli_query($connection, $query);
    check_query($result);
    return $result;
}

function getSingleThread($id) {
    global $connection;
    $query = "SELECT * FROM threads WHERE thread_id={$id}";
    $result = mysqli_query($connection, $query);
    check_query($result);
    $row = mysqli_fetch_assoc($result);
    return $row;
}

function getAllBlogsByUser($id) {
    global $connection;
    $query = "SELECT * FROM blogs WHERE user_id={$id}";
    $result = mysqli_query($connection, $query);
    check_query($result);
    return $result;
}

function getSingleCat($id) {
    global $connection;
    $query = "SELECT * FROM categories WHERE category_id={$id}";
    $result = mysqli_query($connection, $query);
    check_query($result);
    $row = mysqli_fetch_assoc($result);
    return $row;
}

function getAllCommentsByUser($id) {
    global $connection;
    $query = "SELECT * FROM comments WHERE user_id={$id}";
    $result = mysqli_query($connection, $query);
    check_query($result);
    return $result;
}

function getSingleThreadBoard($id) {
    global $connection;
    $query = "SELECT * FROM boards WHERE board_id={$id}";
    $result = mysqli_query($connection, $query);
    check_query($result);
    $row = mysqli_fetch_assoc($result);
    return $row;
}

function getSingleUser($id) {
    global $connection;
    $query = "SELECT * FROM users WHERE user_id={$id}";
    $result = mysqli_query($connection, $query);
    check_query($result);
    $row = mysqli_fetch_assoc($result);
    return $row;
}

function getAll($str) {
    global $connection;
    $query = "SELECT * FROM {$str}";
    $result = mysqli_query($connection, $query);
    check_query($result);
    return $result;
}

function getAllSort($str, $sort, $order) {
    global $connection;
    $query = "SELECT * FROM {$str} ORDER BY {$sort} {$order}";
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

function blog_gallery_home($str, $sort, $order) {
    global $connection;
    $i = 0;
    $blogs = getAllSort($str, $sort, $order);
    $len = mysqli_num_rows($blogs);
    while($i < $len) {
        $row = mysqli_fetch_assoc($blogs);
        $blog_id = $row["blog_id"];
        $blog = getById("blogs", "blog_id", $blog_id);
        $user_id = $row['user_id'];
        $user = getById("users", "user_id", $user_id);
        $userRow = mysqli_fetch_assoc($user);
        $user_name_first = $userRow['user_name_first'];
        $user_name_last = $userRow['user_name_last'];
        $user_name_full = $user_name_first." ".$user_name_last;
        $time = $row['blog_time'];
        $blog_content = $row['blog_content_sect_01'];
        $blog_content = strip_tags($blog_content);
        if(strlen($blog_content) > 100) {
            $limitStr = substr($blog_content, 0, 350);

            $blog_content = substr($limitStr, 0, strrpos($limitStr, ' ')).'... <a href="#">Read More</a>';
        }
        $timeSincePost = time_elapsed_string($time);
        echo "<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 blog'>
                <div>
                    <figure>
                        <div class='row'>
                            <img src='assets/img/{$row['blog_image_preview']}' style='height: 350px' alt='' class='col-xs-12 col-sm-12 img-responsive'>
                        </div>
                        <figcaption>
                            <h1>{$row['blog_title']}</h1>
                            <p>{$blog_content}</p>
                        </figcaption>
                    </figure>
                    <div class='row'>
                        <div class='col-xs-12 col-sm-6 text-info-container'><span class='nm'>{$user_name_full}</span> | <span>{$timeSincePost}</span></div>
                        <div class='col-xs-12 col-sm-6 info-icons'><i class='fa fa-user'></i> <span>{$row['blog_comments_count']}</span> <i class='fa fa-heart'></i> <span>{$row['blog_likes_count']}</span></div>
                    </div>
                </div>
            </div>";
        $i++;
    }
}