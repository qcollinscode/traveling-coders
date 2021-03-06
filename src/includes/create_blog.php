<?php
error_reporting(E_ALL);
    if(isset($_POST['add_blog'])) {
        $blog_title = mysqli_real_escape_string($connection, $_POST['blog_title']);
        $blog_tags = mysqli_real_escape_string($connection, $_POST['blog_tags']);
        $blog_image_preview = mysqli_real_escape_string($connection, $_FILES['blog_image_preview']["name"]);
        $blog_image_01 = mysqli_real_escape_string($connection, $_FILES['blog_image_01']["name"]);
        $blog_content_sect_01 = mysqli_real_escape_string($connection, $_POST['blog_content_sect_01']);
        $blog_content_quote_01 = mysqli_real_escape_string($connection, $_POST['blog_content_quote_01']);
        $blog_content_sect_02 = mysqli_real_escape_string($connection, $_POST['blog_content_sect_02']);
        $blog_image_02 = mysqli_real_escape_string($connection, $_FILES['blog_image_02']["name"]);
        $blog_content_sect_03 = mysqli_real_escape_string($connection, $_POST['blog_content_sect_03']);
        $blog_content_quote_02 = mysqli_real_escape_string($connection, $_POST['blog_content_quote_02']);
        $blog_content_sect_04 = mysqli_real_escape_string($connection, $_POST['blog_content_sect_04']);
        $blog_category = $_GET['catId'];
        $blog_time = date("Y-m-d H:i:s");
        $user_id = $_SESSION['userId'];

        echo $blog_tags;

        $uploads_dir = getcwd() . '/assets/img';

        // Image Head
        $tmp_name = $_FILES["blog_image_preview"]["tmp_name"];
        $blog_image_preview = basename($_FILES["blog_image_preview"]["name"]);
        move_uploaded_file($tmp_name, "$uploads_dir/$blog_image_preview");

        // Image 01
        $tmp_name_image_01 = $_FILES["blog_image_01"]["tmp_name"];
        $$blog_image_01 = basename($_FILES["blog_image_01"]["name"]);
        move_uploaded_file($tmp_name_image_01, "$uploads_dir/$blog_image_01");

        // Image 02
        $tmp_name_image_02 = $_FILES["blog_image_02"]["tmp_name"];
        $$blog_image_02 = basename($_FILES["blog_image_02"]["name"]);
        move_uploaded_file($tmp_name_image_02, "$uploads_dir/$blog_image_02");

         echo "hello";

        $query = "INSERT INTO blogs(blog_title, blog_image_preview, category_id, blog_tags, blog_image_01, blog_content_sect_01, blog_content_quote_01, blog_content_sect_02, blog_image_02, blog_content_sect_03, blog_content_quote_02, blog_content_sect_04, blog_time, user_id) ";
        $query .= "VALUES('{$blog_title}', '{$blog_image_preview}', {$blog_category}, '{$blog_tags}', '{$blog_image_01}', '{$blog_content_sect_01}', '{$blog_content_quote_01}', '{$blog_content_sect_02}', '{$blog_image_02}', '{$blog_content_sect_03}', '{$blog_content_quote_02}', '{$blog_content_sect_04}', '{$blog_time}', {$user_id})";
        
 echo "hello";

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
                <label for="blog_title">Title</label>
                <input type="text" name="blog_title" placeholder="Title" class="form-control" required>
            </div>
            <div class="form-group col-md-12">
                <label for="blog_image_preview">Blog Preview Image</label>
                <input type="file" name="blog_image_preview" required>
            </div>
            <div class="form-group col-md-12">
                <label for="blog_image_01">Blog Image 01</label>
                <input type="file" name="blog_image_01" required>
            </div>
            <div class="form-group col-md-12">
                <label for="blog_content_sect_01">Section 01</label>
                <textarea name="blog_content_sect_01" placeholder="Section 01" class="form-control blog-textarea" required></textarea>
            </div>
            <div class="form-group col-md-6">
                <label for="blog_content_quote_01">Section 01 Quote</label>
                <input type="text" name="blog_content_quote_01" placeholder="Section 01 Quote" class="form-control" required>
            </div>
            <div class="form-group col-md-12">
                <label for="blog_content_sect_02">Section 02</label>
                <textarea name="blog_content_sect_02" placeholder="Section 02" class="form-control blog-textarea" required></textarea>
            </div>
            <div class="form-group col-md-6">
                <label for="blog_image_02">Blog Image 02</label>
                <input type="file" name="blog_image_02" required>
            </div>
            <div class="form-group col-md-12">
                <label for="blog_content_sect_03">Section 03</label>
                <textarea name="blog_content_sect_03" placeholder="Section 03" class="form-control blog-textarea" required></textarea>
            </div>
            <div class="form-group col-md-6">
                <label for="blog_content_quote_02">Section 02 Quote</label>
                <input type="text" name="blog_content_quote_02" placeholder="Section 02 Quote" class="form-control" required>
            </div>
            <div class="form-group col-md-12">
                <label for="blog_content_sect_04">Section 04</label>
                <textarea name="blog_content_sect_04" placeholder="Section 04" class="form-control blog-textarea" required></textarea>
            </div>
            <div class="form-group col-md-6">
                <label for="blog_tags">Tags</label>
                <input type="text" name="blog_tags" placeholder="Tags" class="form-control" required>
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