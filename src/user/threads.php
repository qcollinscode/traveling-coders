<?php 
    include_once("includes/user_header.php");
?>
<div class="page">

    <?php 
        if(isset($_GET['p'])) {
            $source = $_GET['p'];
        } else {
            $source = '';
        }

        switch($source) {
            case "view_all";
                include "includes/all_threads.php";
            break;
            default:
                include "includes/latest.php";
            break;
        }
    ?>

</div>

<?php 
    include_once("includes/user_footer.php");
?>