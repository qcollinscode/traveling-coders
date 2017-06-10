<?php 
    $threadId = $_GET['tid'];
    $userId = "";
    if(isset($_SESSION['userId'])) {
        $userId = $_SESSION['userId'];
    }

    if(isset($_POST['post_comment'])) {
        $comment_content = mysqli_real_escape_string($connection, $_POST['comment_content']);
        $comment_time = date("Y-m-d H:i:s");
        $query = "INSERT INTO comments(comment_content, user_id, comment_time, thread_id)";
        $query .= "VALUES('{$comment_content}', $userId, '{$comment_time}', $threadId)";
        $result = mysqli_query($connection, $query);
        check_query($result);
    }



?>

<div class="container-fluid">
    <?php
        $col = 10;
         if(isset($_SESSION['userId'])) {
                if($_SESSION['userId'] == 1) {
                    $col = 12;
                }
         }
        echo "<div class='row'>
                <div class='col-md-12 text-right img-bg'>
                    <div class='row'>
                        <div class='col-md-{$col}'>
                            <div class='title'><h1>Comments</h1></div>
                        </div>
                    </div>
                </div>
            </div>";
?>
    <div class="row">
        <div class="comments-page-bd col-md-12">
            <div class="row comments">
                <?php
                    $i = 0;
                    $comments = getById("comments", "thread_id", $threadId);
                    while($row = mysqli_fetch_assoc($comments)) {
                        $user_id = $row['user_id'];
                        $user = mysqli_fetch_assoc(getById("users", "user_id", $user_id));
                        $time = $row['comment_time'];
                        $timeSincePost = time_elapsed_string($time);
                ?>

                <div class="col-lg-12">
                    <div class="comment">
                        <h1><?php echo $user['user_username']; ?></h1>
                        <p class="date"><span><?php echo $timeSincePost; ?></span></p>
                        <span class="ln"></span>
                        <p class="comment-comment"><?php echo $row['comment_content']; ?></p>
                        <button>reply</button>
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