<?php 
    $user_id = $_SESSION['userId'];
    $user = getSingleUser($userId);
?>

<div class="row">
    <table class="table table-responsive">
        <tr class="info">
            <th>Title</th>
            <th>Views</th>
            <th>Comments</th>
            <th>Category</th>
        </tr>

        <?php 
            $result = getAllThreadsByUser($user_id);
            while($thread = mysqli_fetch_assoc($result)) {
                $boardId = $thread['board_id'];
                $board = getSingleThreadBoard($boardId);
                $category_id = $board['category_id'];
                $category = getSingleCat($category_id);
        ?>

            <tr>
                <th class="col-md-10"><a href='../forums.php?p=posts&thread=<?php echo $thread["thread_id"]?>'><?php echo $thread['thread_title']; ?></a></th>
                <th><?php echo $thread['thread_views_count']; ?></th>
                <th><?php echo $thread['thread_comments_count']; ?></th>
                <th><?php echo $category['category_name']; ?></th>
            </tr>


        <?php
            }
        ?>


    </table>
</div>