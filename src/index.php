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
        <section class="col-sm-12 col-lg-8">
            <br>
            <div class="row news col-sm-12">
                <a href="cnn.com">
                    <img src="assets/img/tea.jpg" class="img-responsive" alt="">
                </a>
                <div class="news-heading">
                    <p>This is the traveling news title</p>
                </div>
            </div>
        </section>
        <section class="col-sm-12 col-lg-4 blogs-preview-section">              
            <div class="row blogs">
                <?php echo blogs_preview("ASC") ?>
            </div>
        </section>
    </div>
</section>

<?php
    include "includes/footer.php";
?>
