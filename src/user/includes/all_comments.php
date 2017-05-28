<?php 
    $user_id = $_SESSION['userId'];
?>

<div class="row">
    <table class="table table-responsive">
        <tr class="info">
            <th>Comment</th>
            <th>Date</th>
            <th>Thread</th>
        </tr>

        <?php 
            $result = getAllCommentsByUser($user_id);
            while($comment = mysqli_fetch_assoc($result)) {
                $threadId = $comment['thread_id'];
                $thread = getSingleThread($threadId);
                $boardId = $thread['board_id'];
                $board = getSingleThreadBoard($boardId);
                $category_id = $board['category_id'];
                $category = getSingleCat($category_id);
        ?>

            <tr>
                <th class="col-md-10"><a href=''><?php echo $comment['comment_content']; ?></a></th>
                <th><?php echo $comment['comment_time']; ?></th>
                <th><?php echo $category['category_name']; ?></th>
            </tr>


        <?php
            }
        ?>


    </table>
</div>