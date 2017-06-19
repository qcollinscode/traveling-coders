<?php
    include "includes/header.php";
?>


<?php 
    if(isset($_GET['p'])) {

        $source = $_GET['p'];

        switch($source) {
            case "logout";
                include "includes/logout.php";
            break;
            default:
                include "wrongpage.php";
            break;
        }
    } 


?>

<?php
    include "includes/footer.php";
?>