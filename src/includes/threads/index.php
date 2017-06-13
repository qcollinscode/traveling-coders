<?php

    $boardId = $_GET['board'];
    $id;
    if(isset($_SESSION['userId'])) {
        $id = $_SESSION['userId'];
    }
    $boardObj = new Boards($connection);
    $boardObj->set_id($boardId);
    $userObj = new Users($connection);
    $boards = $boardObj->get_all_board_threads_sorted();
    $threadObj = new Threads($connection);
?>

<div class="container-fluid threads-section">
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
                            <div class='title'><h1>Threads</h1></div>
                        </div>";

                    if(isset($_SESSION['userId'])) {
                        if($_SESSION['userId'] == 1) {
                            echo "<div class='col-md-12'>
                                <p><a href='forums.php?p=create_thread&board={$boardId}'><button>New Thread <i class='fa fa-plus' aria-hidden='true'></i></button></a></p>
                            </div>";
                        }
                    }

                    echo "</div>
                </div>
            </div>";
    
    ?>
    <?php 
        while($row = mysqli_fetch_assoc($boards)) {
            $threadObj->set_board($row['board_id']);
            $threadObj->set_id($row['thread_id']);
            $latestCommentRow = mysqli_fetch_row($threadObj->get_all_thread_comments_sorted());
            $commentCount = $threadObj->get_thread_comments_count();
            $latestComment = $latestCommentRow[3] == NULL ? $row['thread_time'] : $latestCommentRow[3];
            $user = $userObj->get_user_by_id($row['user_id']);
    ?>


    <div class="row" onclick="window.location = 'forums.php?board=<?php echo $boardId; ?>&thread=<?php echo $row['thread_id']; ?>&comments=1'">
        <div class="thread">
            <div class="title_date">
                <div class="title">
                    <h1><?php echo $row['thread_title']; ?></h1>
                </div>
                <div class="comment-count">
                    <span>Comments</span>
                    <?php echo $commentCount; ?>
                </div>
            </div>
            <div class="latest-comment_thread-created">
                <div class="last-comment-info">
                    <span>Latest Comment</span>
                    <p><?php echo $latestCommentRow[1] == NULL ? $row['thread_content'] : $latestCommentRow[1]; ?></p>
                </div>
                <div class="thread-created">
                    <span>Thread Created</span>
                    <?php echo time_elapsed_string($row['thread_time']); ?>
                </div>
            </div>
        </div>
    </div>

    <?php
        }
    ?>
</div>