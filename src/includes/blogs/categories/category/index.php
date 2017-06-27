<?php 
    $cat_name = ucwords($_GET['category']);
    $cat_id = getIdByName("categories", "category_name", $cat_name);
    $cat_id_row = mysqli_fetch_assoc($cat_id);
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
                        <div class='title'><h1>{$cat_name} Blogs</h1></div>
                    </div>";

                if(isset($_SESSION['userId'])) {
                    if($_SESSION['userId'] == 1) {
                        echo "<div class='col-md-12'>
                            <p><a href='blogs.php?p=create_blog&catId={$cat_id_row['category_id']}'><button>Create New Blog</button></a></p>
                        </div>";
                    }
                }

                echo "</div>
            </div>
        </div></div>";
?>

<div class="category-blogs container">
    <div class="row">
        <?php
            $i = 0;
            $blogs = getById("blogs", "category_id", $cat_id_row['category_id']);
            $len = mysqli_num_rows($blogs);
            $url = "../post.php?p=";
            while($row = mysqli_fetch_assoc($blogs)) {
                $time = $row['blog_time'];
                $user = getById("users", "user_id", $row['user_id']);
                $userRow = mysqli_fetch_assoc($user);
                $name_first = $userRow['user_name_first'];
                $name_last = $userRow['user_name_last'];
                $user_full_name = ucwords($name_first)." ".ucwords($name_last);
                $blog_content = $row['blog_content_sect_01'];
                $url = '<a href="blogs.php?category='.$_GET['category'].'&blog='.$row['blog_id'].'">Read More</a>';
               if(strlen($blog_content) > 100) {
                    $limitStr = substr($blog_content, 0, 340);
                    $blog_content = substr($limitStr, 0, strrpos($limitStr, ' ')).'... '.$url;
                }
                $timeSincePost = time_elapsed_string($time);
                echo "<div class='blog col-md-4'>
                    <div class='title_author'>
                        <h2 class='col-lg-12'>{$row['blog_title']}</h2>
                        <br/>
                        <h3><small>By: {$user_full_name}</small></h3>
                    </div>
                    <div style='background-image: url(assets/img/{$row['blog_image_01']})' class='col-lg-12 img'></div>
                    <div>
                        <p class='col-lg-12'>{$blog_content}</p>
                        <div class='col-lg-12'>
                            <div class='row info-box'>
                                <div class='col-xs-12 col-sm-12 published'><span>Published</span>: {$timeSincePost}</div>
                            </div>
                        </div>
                    </div>
                </div>";
            }



        ?>
    </div>

</div>