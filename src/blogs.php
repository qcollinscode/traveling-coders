<?php
    include "includes/header.php";
?>

<?php 

    // Blog page?
    if(isset($_GET['blog'])) {

        // Index must to be a number.
        if(is_numeric($_GET['blog'])) {
            include "includes/blogs/index.php";
        } else {
            include "wrongpage.php";
        }

    // Categories page?
    } else if(isset($_GET['category'])) {
        if($_GET['category'] == "travel" | $_GET['category'] == "life" | $_GET['category'] == "money") {
            include "includes/blogs/categories/category/index.php";
        } else {
            include "wrongpage.php";
        }

    } else {
        include "includes/blogs/categories/index.php";
    }
 
?>
