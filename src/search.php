<?php
    include "includes/header.php";
?>

<div class="search-page container">
    <div class="row">
        <?php
            $i = 0;
            while($i < 9) {
                echo "<div class='post col-md-3'>
                    <a  class='overlay' href='#$i'></a>
                    <img src='assets/img/tianjin.jpg' class='img-responsive col-lg-12' alt=''>
                    <div>
                        <h1 class='col-lg-12'>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h1>
                        <p class='col-lg-12'>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <div class='col-lg-12'>
                            <div class='row text-box'>
                                <span class='col-lg-6'>10/21/2010</span>
                                <span class='col-lg-6'>Jose Jose</span>
                            </div>
                        </div>
                    </div>
                </div>";
                $i++;
            }



        ?>
    </div>

</div>

<?php
    include "includes/footer.php";
?>
