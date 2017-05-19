<?php
    include "includes/header.php";
?>


<div class="blogs-section">


<?php 
    if(isset($_GET['p'])) {
        $source = $_GET['p'];
    } else {
        $source = '';
    }

    switch($source) {
        case "create_blog";
            include "includes/create_blog.php";
        break;        
        default:
            include "index.php";
        break;
    }
?>



</div>

<?php
    include "includes/footer.php";
?>
