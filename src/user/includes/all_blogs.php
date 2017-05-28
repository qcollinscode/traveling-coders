<?php 
    $user_id = $_SESSION['userId'];
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
            $result = getAllBlogsByUser($user_id);
            while($blog = mysqli_fetch_assoc($result)) {
                $category_id = $blog['category_id'];
                $category = getSingleCat($category_id);
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