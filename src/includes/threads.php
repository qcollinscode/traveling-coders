<?php

    $boardId = $_GET['board'];
    $id;
    if(isset($_SESSION['userId'])) {
        $id = $_SESSION['userId'];
    }
?>

<div class="container-fluid threads-section">
    <?php 
        if(isset($_SESSION['userId'])) {
            echo "<div class='row'>
                <div class='col-md-12 text-right'>
                    <p><a href='{$root}forums?p=create_thread&board={$boardId}'><button>Create New Thread</button></a></p>
                </div>
            </div>";
        }
    
    ?>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-responsive table-hover">
                <tr class="info">
                    <th>Title</th>
                    <th class="text-center">Views</th>
                    <th class="text-center">Likes</th>
                    <th class="text-center">Comments</th>
                </tr>

                <?php 

                    $query = "SELECT * FROM threads WHERE board_id={$boardId}";
                    $result = mysqli_query($connection, $query);
                    check_query($result);
                    $countQuery = "SELECT count(comments.comment_id) as Total FROM comments JOIN threads WHERE threads.thread_id=comments.thread_id GROUP BY threads.thread_id";
                    $countResult = mysqli_query($connection, $countQuery);
                    check_query($countResult);
                    while($row = mysqli_fetch_assoc($result)) {
                          $count = mysqli_fetch_assoc($countResult);
                ?>

                    <tr>
                        <td class="col-md-8"><a href='<?php echo $root; ?>threads?tid=<?php echo $row['thread_id']."&p=comments"; ?>'><?php echo $row['thread_title']; ?></a></td>
                        <td class="col-md-1 text-center"><?php echo $row['thread_views_count']; ?></td>
                        <td class="col-md-1 text-center"><?php echo $row['thread_likes_count']; ?></td>
                        <td class="col-md-1 text-center"><?php echo $count['Total'] === NULL ? 0 : $count['Total']; ?></td>
                    </tr>


                <?php
                    }
                ?>


            </table>
        </div>
    </div>
</div>