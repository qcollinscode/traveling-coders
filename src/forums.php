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
        case "threads";
            include "includes/threads.php";
        break;
        case "posts";
            include "includes/posts.php";
        break;
        default:
            include "wrongpage.php";
        break;
    }
?>

<?php
    include "includes/footer.php";
?>