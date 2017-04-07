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
                            while($x < 4) {
                                echo "<li class='col-xs-12 col-sm-6 col-md-3 col-lg-12'>
                                        <a href='post.php'>
                                            <img src='assets/img/73.jpg'/>
                                            <div>
                                                <h4>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h4>
                                                <span>5 hrs ago</span>
                                                <span>travel</span>
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
                            while($y < 6) {
                                echo "<li class='col-xs-12 col-sm-6 col-md-6 col-lg-12'>
                                        <a href='post.php'>
                                            <img src='assets/img/tianjin.jpg' alt=''>
                                            <div>
                                                <h4>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus iste, sint.</h4>
                                                <span>10 comments</span>
                                                <span>travel</span>
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
                    while($i < 5) {
                        echo "<div class='col-xs-12 col-sm-12 col-md-6 col-lg-12'>
                            <div>
                                <figure>
                                    <div class='row'>
                                        <img src='assets/img/sky.png' alt='' class='col-xs-12 col-sm-12 img-responsive'>
                                    </div>
                                    <figcaption>
                                        <h1>Lorem ipsum dolor sit amet, consectetur adipisicin</h1>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                    </figcaption>
                                </figure>
                                <div class='row'>
                                    <div class='col-xs-12 col-sm-6'><span class='nm'>Jane Jose</span> | <span>3</span>hrs Ago</div>
                                    <div class='col-xs-12 col-sm-6'><i class='fa fa-user'></i> <span>1,209</span> <i class='fa fa-heart'></i> <span>293</span></div>
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
