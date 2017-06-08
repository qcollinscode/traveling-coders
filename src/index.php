<?php
    include "includes/header.php";
?>
<div class="container-fluid jumbotron-container">
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
                <div class="user-blog col-lg-12">
                    <h1>Top Blogs</h1>
                    <ul class="row">


                        <?php echo blogs_aside(); ?>


                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="user-favorites col-lg-12">
                    <h1>Top Threads</h1>
                    <ul class="row">

                        <?php echo threads_aside() ?>

                    </ul>
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
            </div>
        </section>
    </div>
</section>

<?php
    include "includes/footer.php";
?>
