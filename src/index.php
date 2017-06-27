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
                <div class="users-list-container col-lg-12">
                    <h1>Top 5 Bloggers</h1>
                    <ul class="row users-list">


                        <?php echo bloggers_aside(); ?>


                    </ul>
                </div>
            </div>
        </aside>
        <section class="col-lg-7 col-lg-push-1 blogs-preview-section">
            <div class="row header">
                <div class="col-lg-12">
                    <div class="row">
                        <h1>Recent Blogs</h1>
                    </div>
                </div>
            </div>              
            <div class="row blogs">
                <?php echo blogs_preview("ASC") ?>
            </div>
        </section>
    </div>
</section>

<?php
    include "includes/footer.php";
?>
