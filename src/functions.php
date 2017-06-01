<?php
include_once "includes/db.php";
include_once "includes/objects.php";

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

function limit_blog_preview_content_length($blog_content) {
    $blog_content = strip_tags($blog_content);
    if(strlen($blog_content) > 100) {
        $limitStr = substr($blog_content, 0, 400);
        return $blog_content = substr($limitStr, 0, strrpos($limitStr, ' '));
    }
}


function blogs_aside() {
    global $connection;
    $blogObj = new Blogs($connection);
    $blogs = $blogObj->get_all_blogs_sorted("blog_time", "ASC");
    while($row = mysqli_fetch_assoc($blogs)) {
        $timeSincePost = time_elapsed_string($row['blog_time']);
        echo "<li class='col-xs-12 col-sm-6 col-md-3 col-lg-12'>
                <a href='post.php?p={$row["blog_id"]}'>
                    <img src='assets/img/73.jpg'/>
                    <div>
                        <h4>{$row['blog_title']}</h4>
                        <span>{$timeSincePost}</span>
                    </div>
                </a>
            </li>";
    };
}

function threads_aside() {
    global $connection;
    $threadObj = new Threads($connection);
    $threads = $threadObj->get_all_threads_sorted("thread_time", "ASC");
    while($row = mysqli_fetch_assoc($threads)) {
        echo "<li class='col-xs-12 col-sm-6 col-md-6 col-lg-12'>
                <a href='post.php'>
                    <img src='assets/img/tianjin.jpg' alt=''>
                    <div>
                        <h4>{$row["thread_title"]}</h4>
                        <span>{$row["thread_views_count"]} Users</span>
                    </div>
                </a>
            </li>";
    };
}

function blogs_preview() {
    global $connection;
    $blogObj = new Blogs($connection);
    $userObj = new Users($connection);
    $blogs = $blogObj->get_all_blogs_sorted("blog_time", "ASC");
    while($row = mysqli_fetch_assoc($blogs)) {
        $user = $userObj->get_user_by_id($row['user_id']);
        $user_name_full = $user['user_name_first']." ".$user['user_name_last'];
        $blog_content = limit_blog_preview_content_length($row['blog_content_sect_01']).'... <a href="#">Read More</a>';
        $timeSincePost = time_elapsed_string($row['blog_time']);
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
                    <div class='col-xs-12 col-sm-6 info-icons'><i class='fa fa-user'></i> <span>{$row['blog_view_count']}</span> <i class='fa fa-heart'></i> <span>{$row['blog_likes_count']}</span></div>
                </div>
            </div>
        </div>";
    }
}

function social($user_id) {
    global $connection;
    $usersObj = new Users($connection);
    $usersObj->set_id($user_id);
    $user = $usersObj->get_user_by_id();
    if($user['twitter'] != null) {
        echo "<div class='col-lg-1'><a href='{$user['twitter']}'><i class='fa fa-twitter'></i></a></div>";
    }
    if($user['facebook']) {
        echo "<div class='col-lg-1'><a href='{$user['facebook']}'><i class='fa fa-facebook'></i></a></div>";
    }
    if($user['instagram']) {
        echo "<div class='col-lg-1'><a href='{$user['instagram']}'><i class='fa fa-instagram'></i></a></div>";
    }
}

function comments($blog_id) {
    global $connection;
    $commentsObj = new Comments($connection);
    $usersObj = new Users($connection);
    $comments = $commentsObj->get_all_comments_sorted("blog_id", $blog_id);
    while($row = mysqli_fetch_assoc($comments)) {
        $usersObj->set_id($row['user_id']);
        $user = $usersObj->get_user_by_id();
        $time = $row['comment_time'];
        $timeSincePost = time_elapsed_string($time);
        echo "<div class='comment'>
            <h1>{$user['user_username']}</h1>
            <p class='date'><span>$timeSincePost</span></p>
            <span class='ln'></span>
            <p class='comment-comment'>{$row['comment_content']}</p>
            <button>reply</button>
        </div>";
    }
}