<?php
    if(isset($_POST['add_thread'])) {
        $thread_title = mysqli_real_escape_string($connection, $_POST['thread_title']);
        $category_id = mysqli_real_escape_string($connection, $_POST['category']);
        $user_id = $_SESSION['userId'];

        $query = "INSERT INTO threads(thread_title, category_id, thread_date, user_id)";
        $query .= "VALUES('{$thread_title}', '{$category_id}', now(), {$user_id})";
        $create_thread = mysqli_query($connection, $query);

        check_query($create_thread);
        header("Location: forums?p=threads");
    }
?>


<div class="container create-thread-section">
    <form action="" method="POST">
        <div class="row">
            <div class="form-group col-md-12">
                <label for="thread_title">Title</label>
                <input type="text" name="thread_title" placeholder="Title" class="form-control" required>
            </div>
            <div class="form-group col-md-4">
                <label for="category">Category</label>
                <select name="category" class="form-control" required>
                    <?php 
                        $query = "SELECT * FROM categories";
                        $result = mysqli_query($connection, $query);
                        check_query($result);
                        while($row = mysqli_fetch_assoc($result)) { 
                    ?>
                    <option value='<?php echo $row['category_id']; ?>'><?php echo $row['category_name']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <br/>
                <p><button type="submit" class="btn" name="add_thread">Create Thread</button></p>
            </div>
        </div>
    </form>
</div>