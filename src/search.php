<?php
    include "includes/header.php";
    $tags = $_GET['q'];
    $blogsObj = new Blogs($connection);
    $blogsObj->set_search_query($tags);
    $categoriesObj = new Categories($connection);
?>

<?php
    $col = 12;
        if(isset($_SESSION['userId'])) {
            if($_SESSION['userId'] == 1) {
                $col = 10;
            }
        }
    echo "<div class='container-fluid'><div class='row'>
            <div class='col-md-12 text-right img-bg'>
                <div class='row'>
                    <div class='col-md-{$col}'>
                        <div class='title'><h1>Results</h1></div>
                    </div>
                </div>
            </div>
        </div>
    </div>";
?>

<div class="blog-page container">
    <div class="row">
        <?php
            $blogs = $blogsObj->search_blogs();
            $len = mysqli_num_rows($blogs);
            $url = "../blogs.php?p=";
            if($len < 1) {
                echo '<h1>&nbsp;There are no results.</h1>';
            }
            while($row = mysqli_fetch_assoc($blogs)) {
                $time = $row['blog_time'];
                $user = getById("users", "user_id", $row['user_id']);
                $userRow = mysqli_fetch_assoc($user);
                $name_first = $userRow['user_name_first'];
                $name_last = $userRow['user_name_last'];
                $category = $row['category_id'];
                $blog_id = $row['blog_id'];
                $categoriesObj->set_id($category);
                $category_name = $categoriesObj->get_category_by_id();
                $user_full_name = $name_first." ".$name_last;
                $blog_content = $row['blog_content_sect_01'];
                $url = '<a href="blogs.php?category='.strtolower($category_name['category_name']).'&blog='.$blog_id.'">Read More</a>';
               if(strlen($blog_content) > 100) {
                    $limitStr = substr($blog_content, 0, 350);
                    $blog_content = substr($limitStr, 0, strrpos($limitStr, ' ')).'... '.$url;
                }
                $timeSincePost = time_elapsed_string($time);
                echo "<div class='post col-md-4'>
                <div style='background-image: url(assets/img/{$row['blog_image_01']})' class='col-lg-12 img'></div>
                <div>
                    <h1 class='col-lg-12'>{$row['blog_title']}</h1>
                    <p class='col-lg-12'>{$blog_content}</p>
                    <div class='col-lg-12'>
                        <div class='row text-box'>
                            <span class='col-lg-6'>Posted: {$timeSincePost}</span>
                            <span class='col-lg-6'>{$user_full_name}</span>
                        </div>
                    </div>
                </div>
            </div>";
            }



        ?>
    </div>

</div>

<?php
    include "includes/footer.php";
?>
