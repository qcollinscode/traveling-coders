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
            case "avatar";
                include "includes/avatar.php";
            break;
            case "posts";
                include "includes/all_posts.php";
            break;
            case "comments";
                include "includes/all_comments.php";
            break;
            case "likes";
                include "includes/all_likes.php";
            break;
            case "messages";
                include "includes/all_messages.php";
            break;
            case "info";
                include "includes/all_info.php";
            break;
            case "password";
                include "includes/password.php";
            break;
            case "preview";
                include "includes/preview.php";
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