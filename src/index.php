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
                            $posts = getAll("posts");
                            $len = mysqli_num_rows($posts);
                            while($x < $len) {
                                $row = mysqli_fetch_assoc($posts);
                                $thread_id = $row["thread_id"];
                                $thread = getById("threads", "thread_id", $thread_id);
                                $thread_category_id = $thread['category_id'];
                                $category = getById("categories", "category_id", $thread_category_id);
                                echo "<li class='col-xs-12 col-sm-6 col-md-3 col-lg-12'>
                                        <a href='post.php'>
                                            <img src='assets/img/73.jpg'/>
                                            <div>
                                                <h4>{$row['post_title']}</h4>
                                                <span>5 hrs ago</span>
                                                <span>{$category['category_name']}</span>
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
                                $category_id = $row["category_id"];
                                $category = getById("categories", "category_id", $category_id);
                                echo "<li class='col-xs-12 col-sm-6 col-md-6 col-lg-12'>
                                        <a href='post.php'>
                                            <img src='assets/img/tianjin.jpg' alt=''>
                                            <div>
                                                <h4>{$row["thread_title"]}</h4>
                                                <span>{$row["thread_users_count"]} Users</span>
                                                <span>{$category["category_name"]}</span>
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
                    <div class="row">
                        <h1><span class="selected">popular</span> <span>newest</span></h1>
                    </div>
                </div>
            </div>
            <div class="row articles text-center">
                <?php
                    $i = 0;
                    $posts = getAll("posts");
                    $len = mysqli_num_rows($posts);
                    while($i < $len) {
                        $row = mysqli_fetch_assoc($posts);
                        $thread_id = $row["thread_id"];
                        $thread = getById("threads", "thread_id", $thread_id);
                        $thread_category_id = $thread['category_id'];
                        $category = getById("categories", "category_id", $thread_category_id);
                        $user_id = $row['user_id'];
                        $user = getById("users", "user_id", $user_id);
                        $user_name_first = $user['user_name_first'];
                        $user_name_last = $user['user_name_last'];
                        $user_name_full = $user_name_first." ".$user_name_last;

                        echo "<div class='col-xs-12 col-sm-12 col-md-6 col-lg-12'>
                            <div>
                                <figure>
                                    <div class='row'>
                                        <img src='assets/img/{$row['post_image']}' alt='' class='col-xs-12 col-sm-12 img-responsive'>
                                    </div>
                                    <figcaption>
                                        <h1>{$row['post_title']}</h1>
                                        <p>{$row['post_content']}</p>
                                    </figcaption>
                                </figure>
                                <div class='row'>
                                    <div class='col-xs-12 col-sm-6'><span class='nm'>{$user_name_full}</span> | <span>3</span>hrs Ago</div>
                                    <div class='col-xs-12 col-sm-6'><i class='fa fa-user'></i> <span>{$row['post_comments_count']}</span> <i class='fa fa-heart'></i> <span>{$row['post_likes_count']}</span></div>
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
