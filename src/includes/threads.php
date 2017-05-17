<?php 
    $id = $_SESSION['userId'];
?>

<div class="container-fluid">
    <div class="row">
        <table class="table table-responsive">
            <tr class="info">
                <th>Title</th>
                <th>Views</th>
                <th>Users</th>
                <th>Category</th>
            </tr>

            <?php 
                $query = "SELECT * FROM threads";
                $result = mysqli_query($connection, $query);
                check_query($result);
                while($thread = mysqli_fetch_assoc($result)) {
            ?>

                <tr>
                    <th><a href='<?php echo $root; ?>forums?p=posts&thread_id=<?php echo $thread["thread_id"]?>'><?php echo $thread['thread_title']; ?></a></th>
                    <th><?php echo $thread['thread_views_count']; ?></th>
                    <th><?php echo $thread['thread_users_count']; ?></th>
                    <th><?php echo $thread['thread_category']; ?></th>
                </tr>


            <?php
                }
            ?>


        </table>
    </div>
</div>