<?php 
    $id;
    if(isset($_SESSION['userId'])) {
        $id = $_SESSION['userId'];
    }
    
?>
<div class="container-fluid boards-section">
<?php
        $col = 10;
         if(isset($_SESSION['userId'])) {
                if($_SESSION['userId'] == 1) {
                    $col = 12;
                }
         }
        echo "<div class='row'>
                <div class='col-md-12 text-right img-bg'>
                    <div class='row'>
                        <div class='col-md-{$col}'>
                            <div class='title'><h1>Boards</h1></div>
                        </div>";

                    if(isset($_SESSION['userId'])) {
                        if($_SESSION['userId'] == 1) {
                            echo "<div class='col-md-12'>
                                <p><a href='forums.php?p=create_board'><button>New Board <i class='fa fa-plus' aria-hidden='true'></i></button></a></p>
                            </div>";
                        }
                    }

                    echo "</div>
                </div>
            </div>";
?>
    <div class="row">
        <table class="table table-responsive">
            <tr class="headings">
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

                    <tr class="data" onclick="window.location = 'forums.php?p=threads&board=<?php echo $board["board_id"]?>'">
                            
                            <td class="col-md-10"><?php echo $board['board_title']; ?></td>
                            <td><?php echo $board['board_views_count']; ?></td>
                            <td><?php echo $board['board_users_count']; ?></td>
                            <td><?php echo $category['category_name']; ?></td>

                    </tr>


            <?php
                }
            ?>


        </table>
    </div>
</div>