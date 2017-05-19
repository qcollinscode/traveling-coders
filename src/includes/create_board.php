<?php
    if(isset($_POST['add_board'])) {
        $board_title = mysqli_real_escape_string($connection, $_POST['board_title']);
        $category_id = mysqli_real_escape_string($connection, $_POST['category']);
        $board_time = date("Y-m-d H:i:s");
        $user_id = $_SESSION['userId'];

        $query = "INSERT INTO boards(board_title, category_id, board_date, user_id)";
        $query .= "VALUES('{$board_title}', '{$category_id}', '{$board_time}', {$user_id})";
        $create_board = mysqli_query($connection, $query);

        check_query($create_board);
        header("Location: forums?p=boards");
    }
?>


<div class="container create-board-section">
    <form action="" method="POST">
        <div class="row">
            <div class="form-group col-md-12">
                <label for="board_title">Title</label>
                <input type="text" name="board_title" placeholder="Title" class="form-control" required>
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
                <p><button type="submit" class="btn" name="add_board">Create Board</button></p>
            </div>
        </div>
    </form>
</div>