<?php 
    $user_id = $_SESSION['userId'];
    $blogObj = new Blogs($connection);
    $categoryObj = new Categories($connection);
    $blogObj->set_user_id($user_id);
?>

<div class="row">
    <table class="table table-responsive">
        <tr class="info">
            <th>Title</th>
            <th>Image</th>
            <th>Date</th>
            <th>Category</th>
        </tr>

        <?php 
            $blogs = $blogObj->get_all_blogs_by_user_id();
            while($blog = mysqli_fetch_assoc($blogs)) {
                $categoryObj->set_id($blog['category_id']);
                $category = $categoryObj->get_category_by_id();
        ?>

            <tr>
                <th class="col-md-6"><?php echo $blog['blog_title']; ?></th>
                <th class=""><img src="../assets/img/<?php echo $blog['blog_image_preview']; ?>" class="img-responsive" style='width: 120px'></th>
                <th><?php echo $blog['blog_time']; ?></th>
                <th><?php echo $category['category_name']; ?></th>
            </tr>


        <?php
            }
        ?>


    </table>
</div>