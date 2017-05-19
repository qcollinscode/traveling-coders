<?php
    include "includes/header.php";
?>


<?php 
    if(isset($_GET['p'])) {
        $source = $_GET['p'];
    } else {
        $source = '';
    }

    switch($source) {
        case "boards";
            include "includes/boards.php";
        break;
        case "threads";
            include "includes/threads.php";
        break;
        case "create_board";
            include "includes/create_board.php";
        break;
        case "create_thread";
            include "includes/create_thread.php";
        break;
        default:
            include "wrongpage.php";
        break;
    }
?>

<?php
    include "includes/footer.php";
?>