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

<div class="container-fluid comments-page">
    
    <?php main_comment($threadId); ?>

    <?php thread_comments($threadId)?>
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