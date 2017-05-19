<?php 

    include_once("includes/header.php");
    $thread_id = $_GET['tid'];
?>
<?php
    if(isset($_GET['p'])) {
        $source = $_GET['p'];
    } else {
        $source = "";
    }
?>

<?php 

    switch($source) {
        case "comments":
            include "includes/comments.php";
        break;
        default:
            header("Location: /traveling-coders/src/");
        break;
    }
?>


<?php 
    include_once("includes/footer.php");
?>