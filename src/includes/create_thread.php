<?php
    if(isset($_POST['add_thread'])) {
        $thread_title = mysqli_real_escape_string($connection, $_POST['thread_title']);
        $thread_tags = mysqli_real_escape_string($connection, $_POST['thread_tags']);
        $thread_time = date("Y-m-d H:i:s");
        $board_id = $_GET['board'];
        $user_id = $_SESSION['userId'];

        $query = "INSERT INTO threads(thread_title, thread_tags, board_id, user_id, thread_time)";
        $query .= "VALUES('{$thread_title}', '{$thread_tags}', {$board_id}, {$user_id}, '{$thread_time}')";
        $create_thread = mysqli_query($connection, $query);

        check_query($create_thread);
        header("Location: forums.php?p=threads&board=$board_id");
    }
?>


<div class="container create-thread-section">
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="form-group col-md-12">
                <label for="thread_title">Title</label>
                <input type="text" name="thread_title" placeholder="Title" class="form-control" required>
            </div>
            <div class="form-group col-md-12">
                <label for="thread_title">Tags</label>
                <input type="text" name="thread_tags" placeholder="Tags" class="form-control" required>
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