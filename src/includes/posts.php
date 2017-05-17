<?php

$threadId = $_GET['thread_id'];

?>

<?php 
    $id = $_SESSION['userId'];
?>

<div class="container-fluid">
    <div class="row">
        <table class="table table-responsive">
            <tr class="info">
                <th>Title</th>
                <th>Views</th>
                <th>Likes</th>
                <th>Category</th>
            </tr>

            <?php 
                $query = "SELECT * FROM posts WHERE thread_id={$threadId}";
                $result = mysqli_query($connection, $query);
                check_query($result);
                while($post = mysqli_fetch_assoc($result)) {
            ?>

                <tr>
                    <th><?php echo "<a href=''>{$post['post_title']}</a>" ?></th>
                    <th><?php echo $post['post_views_count']; ?></th>
                    <th><?php echo $post['post_likes_count']; ?></th>
                    <th><?php echo $post['post_category']; ?></th>
                </tr>


            <?php
                }
            ?>


        </table>
    </div>
</div>