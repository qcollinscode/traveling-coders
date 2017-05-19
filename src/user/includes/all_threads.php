<?php 
    $user_id = $_SESSION['userId'];
?>

<div class="row">
    <table class="table table-responsive">
        <tr class="info">
            <th>Title</th>
            <th>Views</th>
            <th>Users</th>
            <th>Category</th>
        </tr>

        <?php 
            $query = "SELECT * FROM threads WHERE user_id={$user_id}";
            $result = mysqli_query($connection, $query);
            check_query($result);
            while($thread = mysqli_fetch_assoc($result)) {
                $category_id = $thread['category_id'];
                $category = getById("categories", "category_id", $category_id);
        ?>

            <tr>
                <th class="col-md-10"><a href='../forums.php?p=posts&thread=<?php echo $thread["thread_id"]?>'><?php echo $thread['thread_title']; ?></a></th>
                <th><?php echo $thread['thread_views_count']; ?></th>
                <th><?php echo $thread['thread_users_count']; ?></th>
                <th><?php echo $category['category_name']; ?></th>
            </tr>


        <?php
            }
        ?>


    </table>
</div>