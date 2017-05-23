<?php 
    $id;
    if(isset($_SESSION['userId'])) {
        $id = $_SESSION['userId'];
    }
    
?>
<div class="container-fluid boards-section">
<?php
    if(isset($_SESSION['userId'])) {
        echo "<div class='row'>
                <div class='col-md-12 text-right'>
                    <p><a href='forums.php?p=create_board'><button>Create New Board</button></a></p>
                </div>
            </div>";
    }
?>
    <div class="row">
        <table class="table table-responsive">
            <tr class="info">
                <th>Title</th>
                <th>Views</th>
                <th>Users</th>
                <th>Category</th>
            </tr>

            <?php 
                $query = "SELECT * FROM boards";
                $result = mysqli_query($connection, $query);
                check_query($result);
                while($board = mysqli_fetch_assoc($result)) {
                    $category_id = $board['category_id'];
                    $category = mysqli_fetch_assoc(getById("categories", "category_id", $category_id));
            ?>

                <tr>
                    <th class="col-md-10"><a href='forums.php?p=threads&board=<?php echo $board["board_id"]?>'><?php echo $board['board_title']; ?></a></th>
                    <th><?php echo $board['board_views_count']; ?></th>
                    <th><?php echo $board['board_users_count']; ?></th>
                    <th><?php echo $category['category_name']; ?></th>
                </tr>


            <?php
                }
            ?>


        </table>
    </div>
</div>