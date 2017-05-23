<?php
    include "includes/header.php";
?>
<div class="container-fluid">
    <div class="row">
        <div class="home-jumbotron jumbotron">
            <div class="logo">
                <img src="assets/img/logo3.svg" alt="">
            </div>
            <div class="brds"></div>
        </div>
    </div>
</div>
<section class="wrapper container-fluid">
    <div class="row">
        <aside class="col-lg-3">
            <div class="row">
                <nav class="latest-news col-lg-12">
                    <h1>Latest News</h1>
                    <ul>
                        <li><a href="#"><i class="fa fa-user"></i>Home</a></li>
                        <li><a href="#"><i class="fa fa-user"></i>Travel</a></li>
                        <li><a href="#"><i class="fa fa-user"></i>Life</a></li>
                        <li><a href="#"><i class="fa fa-user"></i>Money</a></li>
                    </ul>
                </nav>
            </div>
            <div class="row">
                <div class="user-blog col-lg-12">
                    <h1>User Blogs</h1>
                    <ul class="row">
                        <?php
                            $x = 0;
                            $blogs = getAllSort("blogs", "blog_time", "DESC");
                            $len = mysqli_num_rows($blogs);
                            while($x < $len) {
                                $row = mysqli_fetch_assoc($blogs);
                                $time = $row['blog_time'];
                                $timeSincePost = time_elapsed_string($time);
                                $blog_id = $row["blog_id"];
                                $blog = getById("blogs", "blog_id", $blog_id);
                                echo "<li class='col-xs-12 col-sm-6 col-md-3 col-lg-12'>
                                        <a href='post.php'>
                                            <img src='assets/img/73.jpg'/>
                                            <div>
                                                <h4>{$row['blog_title']}</h4>
                                                <span>{$timeSincePost}</span>
                                            </div>
                                        </a>
                                    </li>";
                                    $x++;
                            };

                        ?>
                    </ul>
                    <button type="button" class="btn btn-block">Load more</button>
                </div>
            </div>
            <div class="row">
                <div class="user-favorites col-lg-12">
                    <h1>Top Threads</h1>
                    <ul class="row">
                        <?php
                            $y = 0;
                            $threads = getAll("threads");
                            $len = mysqli_num_rows($threads);
                            while($y < $len) {
                                $row = mysqli_fetch_assoc($threads);
                                echo "<li class='col-xs-12 col-sm-6 col-md-6 col-lg-12'>
                                        <a href='post.php'>
                                            <img src='assets/img/tianjin.jpg' alt=''>
                                            <div>
                                                <h4>{$row["thread_title"]}</h4>
                                                <span>{$row["thread_views_count"]} Users</span>
                                            </div>
                                        </a>
                                    </li>";
                                    $y++;
                            };

                        ?>
                    </ul>
                    <button type="button" class="btn btn-block">Load more</button>
                </div>
            </div>
        </aside>
        <section class="col-lg-7 col-lg-push-1 main-section">
            <div class="row header">
                <div class="col-lg-12">
                    <div class="row sort">
                        <h1><span class="selected">popular</span> <span>newest</span></h1>
                    </div>
                </div>
            </div>
            <div class="row blogs text-center">
                <div class="loader-container">
                    <div class="loader"></div>
                </div>
                <?php
                    $i = 0;
                    $blogs = getAll("blogs");
                    $len = mysqli_num_rows($blogs);
                    while($i < $len) {
                        $row = mysqli_fetch_assoc($blogs);
                        $blog_id = $row["blog_id"];
                        $blog = getById("blogs", "blog_id", $blog_id);
                        $user_id = $row['user_id'];
                        $user = getById("users", "user_id", $user_id);
                        $userRow = mysqli_fetch_assoc($user);
                        $user_name_first = $userRow['user_name_first'];
                        $user_name_last = $userRow['user_name_last'];
                        $user_name_full = $user_name_first." ".$user_name_last;
                        $time = $row['blog_time'];
                        $blog_content = $row['blog_content'];
                        $blog_content = strip_tags($blog_content);
                        if(strlen($blog_content) > 100) {

                            $limitStr = substr($blog_content, 0, 350);

                            $blog_content = substr($limitStr, 0, strrpos($limitStr, ' ')).'... <a href="#">Read More</a>';
                        }
                        $timeSincePost = time_elapsed_string($time);
                        echo "<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 blog'>
                            <div>
                                <figure>
                                    <div class='row'>
                                        <img src='assets/img/{$row['blog_image']}' alt='' class='col-xs-12 col-sm-12 img-responsive'>
                                    </div>
                                    <figcaption>
                                        <h1>{$row['blog_title']}</h1>
                                        <p>{$blog_content}</p>
                                    </figcaption>
                                </figure>
                                <div class='row'>
                                    <div class='col-xs-12 col-sm-6 text-info-container'><span class='nm'>{$user_name_full}</span> | <span>{$timeSincePost}</span></div>
                                    <div class='col-xs-12 col-sm-6 info-icons'><i class='fa fa-user'></i> <span>{$row['blog_comments_count']}</span> <i class='fa fa-heart'></i> <span>{$row['blog_likes_count']}</span></div>
                                </div>
                            </div>
                        </div>";
                        $i++;
                    }
                ?>
            </div>
        </section>
    </div>
</section>

<?php
    include "includes/footer.php";
?>
