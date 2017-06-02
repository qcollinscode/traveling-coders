<?php 
    $user_id = $_SESSION['userId'];
    $commentsObj = new Comments($connection);
    $commentsObj->set_user($user_id);
?>

<div class="row">
    <table class="table table-responsive">
        <tr class="info">
            <th>Comment</th>
            <th>Date</th>
        </tr>

        <?php 
            $result = $commentsObj->get_all_comments_by_user_id();
            while($comment = mysqli_fetch_assoc($result)) {
        ?>

            <tr>
                <th class="col-md-10"><a href=''><?php echo $comment['comment_content']; ?></a></th>
                <th><?php echo $comment['comment_time']; ?></th>
            </tr>


        <?php
            }
        ?>


    </table>
</div>