<?php 
    $threadId = $_GET['thread'];
    $userId = "";
    $threadObj = new Threads($connection);
    $threadObj->set_id($_GET['thread']);
    $userObj = new Users($connection);
    $threadObj->set_id($threadId);
    $thread = $threadObj->get_thread_by_id();
    $userObj->set_id($thread['user_id']);
    $threadUser = $userObj->get_user_by_id();
    if(isset($_SESSION['userId'])) {
        $userId = $_SESSION['userId'];
    }

    if(isset($_POST['post_comment'])) {
        $threadObj->set_comment_content($_POST['comment_content']);
        $threadObj->set_user_id($userId);
        $threadObj->add_comment();
    }



?>

<div class="container-fluid">
    <?php
        echo "<div class='row'>
                <div class='col-md-12 text-right img-bg'>
                    <div class='row'>
                        <div class='col-md-12'>
                            <div class='title'><h1>Comments</h1></div>
                        </div>
                    </div>
                </div>
            </div>";
?>

    <div class="row">
        <div class="comments-page-bd col-md-12">
            <div class="row comments">
                    <div class="row">
                        <div class="thread">
                            <div class="title_date">
                                <div class="title">
                                    <h1><?php echo $thread['thread_title']; ?></h1>
                                </div>
                            </div>
                            <div class="comment-user-cat">
                                <div class="user-info" onclick="window.location = '../user/<?php echo $threadUser['user_username']; ?>'">
                                    <img src="../assets/img/73.jpg" alt="">
                                    <div class="user-name">
                                        <p><?php echo $threadUser['user_username']; ?></p>
                                    </div>
                                </div>
                                <div class="last-comment-info">
                                    <p><?php echo $thread['thread_content']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <h3>Comments</h3>
                <?php
                    $comments = $threadObj->get_all_thread_comments_sorted("ASC");
                    while($row = mysqli_fetch_assoc($comments)) {
                        $userObj->set_id($row['user_id']);
                        $user = $userObj->get_user_by_id();
                        $timeSincePost = time_elapsed_string($row['comment_time']);
                ?>

                <div class="row">
                    <div class="comment">
                        <div class="comment-user-cat">
                            <div class="user-info" onclick="window.location = 'user/<?php echo $user['user_username']; ?>'">
                                <img src="../assets/img/73.jpg" alt="">
                                <div class="user-name">
                                    <p><?php echo $user['user_username']; ?></p>
                                </div>
                            </div>
                            <div class="comment-content-likes">
                                <div class="content">
                                    <p><?php echo $row['comment_content']; ?></p>
                                </div>
                                <div class="likes">
                                    <p><i class="fa fa-heart"></i></p><span>
                                        <?php 
                                            $likes_count = $row['comment_likes_count'];
                                            if ($likes_count == 0) {
                                                echo "";
                                            } else if($likes_count == 1) {
                                                echo $likes_count . " " . "Like";
                                            } else if($likes_count > 1 ) {
                                                echo $likes_count . " " . "Likes";
                                            }
                                        
                                        ?>
                                    </span>
                                </div>
                            </div>
                            <div class="comment-created">
                                <span>Comment Posted</span>
                                <?php echo time_elapsed_string($row['comment_time']); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                    }
                ?>
            </div>
        </div>
    </div>



    <?php if(isset($_SESSION['userId'])) { ?>
        <div class="row leave-reply">
            <div class="col-lg-12">
                <div>
                    <form action="" method="POST" class="row">
                        <div class="form-input col-lg-12">
                            <label for="comment-box">Comment</label>
                            <textarea name="comment_content" type="textarea"></textarea>
                        </div>
                        <div class="col-lg-3">
                            <button type="submit" name="post_comment">Post Comment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>
</div>