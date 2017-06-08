<?php
function blogs_preview($order = "ASC") {
    global $connection;
    $blogObj = new Blogs($connection);
    $userObj = new Users($connection);
    $blogs = $blogObj->get_all_blogs_sorted("blog_time", $order);
    while($row = mysqli_fetch_assoc($blogs)) {
        $user = $userObj->get_user_by_id($row['user_id']);
        $user_name_full = $user['user_name_first']." ".$user['user_name_last'];
        $blog_content = limit_blog_preview_content_length($row['blog_content_sect_01']).'... <a href="#">Read More</a>';
        $timeSincePost = time_elapsed_string($row['blog_time']);
        echo "<div class='col-xs-12 col-sm-12 col-md-6 col-lg-12 blog'>
            <div>
                <figure>
                    <div class='row'>
                        <img src='assets/img/{$row['blog_image_preview']}' alt='' class='col-xs-12 col-sm-12 img-responsive'>
                    </div>
                    <figcaption>
                        <h1>{$row['blog_title']}</h1>
                        <p>{$blog_content}</p>
                    </figcaption>
                </figure>
                <div class='row'>
                    <div class='col-xs-12 col-sm-6 text-info-container'><span class='nm'>{$user_name_full}</span> | <span>{$timeSincePost}</span></div>
                    <div class='col-xs-12 col-sm-6 info-icons'><i class='fa fa-comment'></i> <span>{$row['blog_comments_count']}</span> <i class='fa fa-heart'></i> <span>{$row['blog_likes_count']}</span></div>
                </div>
            </div>
        </div>";
    }
}