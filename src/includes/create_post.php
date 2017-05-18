<?php
    if(isset($_POST['add_post'])) {
        $post_title = mysqli_real_escape_string($connection, $_POST['post_title']);
        $post_content = mysqli_real_escape_string($connection, $_POST['post_content']);
        $post_image = mysqli_real_escape_string($connection, $_FILES['post_image']['name']);
        $post_image_temp = mysqli_real_escape_string($connection, $_FILES['post_image']['tmp_name']);
        $post_tags = mysqli_real_escape_string($connection, $_POST['post_tags']);
        $thread_id = $_GET['thread'];
        $user_id = $_SESSION['userId'];
        $uploadDir= "../traveling-coders/src/assets/img/";

        move_uploaded_file($post_image_temp, "../assets/img/$post_image");

        $query = "INSERT INTO posts(post_title, post_content, post_image, post_tags, thread_id, user_id, post_time)";
        $query .= "VALUES('{$post_title}', '{$post_content}', '{$post_image}', '{$post_tags}', {$thread_id}, {$user_id}, now())";
        $create_post = mysqli_query($connection, $query);

        check_query($create_post);
        header("Location: forums?p=posts&thread=$thread_id");
    }
?>


<div class="container create-post-section">
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="form-group col-md-12">
                <label for="post_title">Title</label>
                <input type="text" name="post_title" placeholder="Title" class="form-control" required>
            </div>
            <div class="form-group col-md-4">
                <label for="category">Image</label>
                <input type="file" name="post_image" required>
            </div>
            <div class="form-group col-md-12">
                <label for="post_title">Tags</label>
                <input type="text" name="post_tags" placeholder="Tags" class="form-control" required>
            </div>
            <div class="form-group col-md-12">
                <label for="post_title">Content</label>
                <textarea name="post_content" placeholder="Content" class="form-control" required></textarea>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <br/>
                <p><button type="submit" class="btn" name="add_post">Create post</button></p>
            </div>
        </div>
    </form>
</div>