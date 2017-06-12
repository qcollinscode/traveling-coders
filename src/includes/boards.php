<?php 
    $id;
    if(isset($_SESSION['userId'])) {
        $id = $_SESSION['userId'];
    }
    $boardObj = new Boards($connection);
    $boards = $boardObj->get_all_boards();

    
?>
<div class="container-fluid boards-section">
<?php
        $col = 12;
         if(isset($_SESSION['userId'])) {
                if($_SESSION['userId'] == 1) {
                    $col = 10;
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
<?php 
    while($board = mysqli_fetch_assoc($boards)) {
        $board_id = $board['board_id'];
        $boardObj->set_category($board['category_id']);
        $boardObj->set_id($board_id);
        $thread = mysqli_fetch_assoc($boardObj->get_all_board_threads_sorted());
        $category = $boardObj->get_board_category();
        $thread_count = $boardObj->get_board_thread_count();
?>
    <div class="row">
        <div class="board" onclick="window.location = 'forums.php?p=threads&board=<?php echo $board["board_id"]?>'">
            <div class="title_date">
                <div class="title">
                    <h1><?php echo $board['board_title']; ?></h1>
                </div>
                <div class="thread-count">
                    <span>Threads</span>
                    <?php echo $thread_count; ?>
                </div>
            </div>
            <div class="thread-user-cat">
                <div class="category-name">
                    <span>Category</span>
                    <p><?php echo $category['category_name']; ?></p>
                </div>
                <div class="last-thread-info">
                    <span>Latest Thread</span>
                    <p><?php echo empty($thread['thread_title']) ? "None" : $thread['thread_title']; ?></p>
                </div>
                <div class="last-thread">
                    <span>Last Thread Created</span>
                    <?php echo empty($thread['thread_title']) ? "N/A" : time_elapsed_string($thread['thread_time']); ?>
                </div>
            </div>
        </div>
    </div>

<?php
    }
?>
    </div>
</div>