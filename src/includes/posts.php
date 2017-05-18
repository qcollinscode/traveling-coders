<?php

    $threadId = $_GET['thread'];
    $id;
    if(isset($_SESSION['userId'])) {
        $id = $_SESSION['userId'];
    }
?>

<div class="container-fluid posts-section">
    <?php 
        if(isset($_SESSION['userId'])) {
            echo "<div class='row'>
                <div class='col-md-12 text-right'>
                    <p><a href='<?php echo $root; ?>forums?p=create_post&thread=<?php echo $threadId; ?>'><button>Create New Post</button></a></p>
                </div>
            </div>";
        }
    
    ?>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-responsive table-hover">
                <tr class="info">
                    <th></th>
                    <th>Title</th>
                    <th class="text-center">Views</th>
                    <th class="text-center">Likes</th>
                    <th class="text-center">Category</th>
                </tr>

                <?php 

                    $query = "SELECT * FROM posts WHERE thread_id={$threadId}";
                    $result = mysqli_query($connection, $query);
                    check_query($result);

                    while($post = mysqli_fetch_assoc($result)) {
                    $post_thread_id = $post['thread_id'];
                    $thread = getById("threads", "thread_id", $post_thread_id);
                    $thread_category_id = $thread['category_id'];
                    $category = getById("categories", "category_id", $thread_category_id);
                ?>

                    <tr>
                        <td class="col-md-1"><img class="img-responsive" src="assets/img/<?php echo $post['post_image']; ?>" alt=""/></td>
                        <td class="col-md-8"><?php echo "<a href=''>{$post['post_title']}</a>" ?></td>
                        <td class="col-md-1 text-center"><?php echo $post['post_views_count']; ?></td>
                        <td class="col-md-1 text-center"><?php echo $post['post_likes_count']; ?></td>
                        <td class="col-md-1 text-center"><?php echo $category['category_name']; ?></td>
                    </tr>


                <?php
                    }
                ?>


            </table>
        </div>
    </div>
</div>