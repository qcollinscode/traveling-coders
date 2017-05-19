<?php
    include "includes/header.php";
?>


<?php 
    if(isset($_GET['p'])) {

        $source = $_GET['p'];

        switch($source) {
            case "signup";
                include "includes/signup_form.php";
            break;
            case "login";
                include "includes/login_form.php";
            break;
            case "logout";
                include "includes/logout.php";
            break;
            case "forums";
                include "forums.php";
            break;
            case "travel";
                include "includes/blog_page.php";
            break;
            case "life";
                include "includes/blog_page.php";
            break;
            case "money";
                include "includes/blog_page.php";
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