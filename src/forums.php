<?php
    include "includes/header.php";
?>


<?php 

    // Comments page?
    if(isset($_GET['comments'])) {

        // Index must to be a number.
        if(is_numeric($_GET['comments'])) {
            include "includes/threads/comments.php";
        } else {
            include "wrongpage.php";
        }

    // Thread page?
    } else if(isset($_GET['thread'])) {

        // Index must be a number.
        if(is_numeric($_GET['thread'])) {
            include "includes/threads/index.php";
        
        } else if ($_GET['thread'] == "create") {
            include "includes/threads/create_thread.php";
        } else {
            include "wrongpage.php";
        }

    // Board page?
    } else if(isset($_GET['board'])) {

        if(is_numeric($_GET['board'])) {
            include "includes/threads/index.php";
        } else if ($_GET['board'] == "create") {
            include "includes/boards/create_board.php";
        } else {
            include "wrongpage.php";
        }

    } else {

        include "includes/boards/index.php";
    }
 
?>