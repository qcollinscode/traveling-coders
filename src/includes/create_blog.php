<?php
    echo getcwd();
    if(isset($_POST['add_blog'])) {
        $blog_title = mysqli_real_escape_string($connection, $_POST['board_title']);
        $blog_image = mysqli_real_escape_string($connection, $_FILES['blog_image']["name"]);
        $blog_tags = mysqli_real_escape_string($connection, $_POST['blog_tags']);
        $blog_content = mysqli_real_escape_string($connection, $_POST['blog_content']);
        $blog_category = $_GET['catId'];
        $blog_time = date("Y-m-d H:i:s");
        $user_id = $_SESSION['userId'];

        $uploads_dir = getcwd() . '\assets\img';

        $tmp_name = $_FILES["blog_image"]["tmp_name"];
        $name = basename($_FILES["blog_image"]["name"]);
        move_uploaded_file($tmp_name, "$uploads_dir/$blog_image");

        $query = "INSERT INTO blogs(blog_title, blog_image, category_id, blog_tags, blog_content, blog_time, user_id)";
        $query .= "VALUES('{$blog_title}', '{$blog_image}', {$blog_category}, '{$blog_tags}', '{$blog_content}', '{$blog_time}', {$user_id})";
        
        $create_blog = mysqli_query($connection, $query);
        $cat_name = getCatNameById("categories", "category_id", $blog_category);
        $cat_name_row = mysqli_fetch_assoc($cat_name);
        $cat_name_url = $cat_name_row['category_name'];
        $cat_name_url = strtolower($cat_name_url);
        check_query($cat_name_row);
        header("Location: /sw.php?p=$cat_name_url");
    }
?>


<div class="container create-blog-section">
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="form-group col-md-12">
                <label for="board_title">Title</label>
                <input type="text" name="board_title" placeholder="Title" class="form-control" required>
            </div>
            <div class="form-group col-md-6">
                <label for="blog_image">Blog Image</label>
                <input type="file" name="blog_image" required>
            </div>
            <div class="form-group col-md-6">
                <label for="board_title">Tags</label>
                <input type="text" name="blog_tags" placeholder="Tags" class="form-control" required>
            </div>
            <div class="form-group col-md-12">
                <label for="board_title">Content</label>
                <textarea name="blog_content" placeholder="Content" class="form-control blog-textarea" required></textarea>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <br/>
                <p><button type="submit" class="btn" name="add_blog">Create Blog</button></p>
            </div>
        </div>
    </form>
</div>