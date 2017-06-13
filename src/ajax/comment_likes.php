<?php
    include "functions.php";
    $comment_id = $_POST['cid'];
    $user_id = $_SESSION['userId'];

    return add_comment_likes($comment_id, $user_id);