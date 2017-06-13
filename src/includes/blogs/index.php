<?php
    $blogObj = new Blogs($connection);
    $userObj = new Users($connection);
    $commentObj = new Comments($connection);

    $blog_id = $_GET['blog'];

    // Blog ID
    $blogObj->set_id($blog_id);

    // Get blog by blog ID
    $blog = $blogObj->get_blog_by_id();

    // User ID
    $userObj->set_id($blog['user_id']);

    // Get user by user ID
    $user = $userObj->get_user_by_id();

    if(isset($_SESSION['userId'])) {
        $user_id = $_SESSION['userId'];
    }

    $commentObj->set_blog($blog_id);
    
?>

<section class="post-section container">
    <div class="row">
        <div class="col-lg-12">
            <div class="post-info">
                <h1 class="title"><?php echo $blog['blog_title']; ?></h1>
            </div>
        </div>
        <div class="col-lg-12 para">
            <img src="assets/img/<?php echo $blog['blog_image_01']; ?>" alt="" class="img-responsive">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 para">
            <p><?php echo $blog['blog_content_sect_01']; ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 para">
            <blockquote cite="http://"><?php echo $blog['blog_content_quote_01']; ?></blockquote>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 para">
            <p><?php echo $blog['blog_content_sect_02']; ?></p>
        </div>
    </div>
    <div class="row">
        <div class="para col-xs-12 col-lg-6 para">
            <img src="assets/img/<?php echo $blog['blog_image_02']; ?>" alt="" class="img-hf img-responsive">
        </div>
        <div class="para col-xs-12 col-lg-6">
            <p><?php echo $blog['blog_content_sect_03']; ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 para">
            <blockquote cite="http://"><?php echo $blog['blog_content_quote_02']; ?></blockquote>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 para">
            <p><?php echo $blog['blog_content_sect_04']; ?></p>
        </div>
    </div>
    <div class="row tags-soc">
        <div class="col-lg-10 tags">
            <p>TAGS:
                <span><a href="#"> Tech </a><span class="slash">|</span> </span>
            <span><a href="#"> Money </a><span class="slash">|</span> </span>
            <span><a href="#"> Life </a><span class="slash">|</span> </span>
            <span><a href="#"> Relationships </a><span class="slash">|</span> </span>
            <span><a href="#"> Travel </a> </span></p>
        </div>
        <div class="col-xs-12 col-lg-2">
            <div class="row">
                <div class="col-xs-3 col-lg-3 text-center"><a href="#"><i class="fa fa-twitter"></i></a></div>
                <div class="col-xs-3 col-lg-3 text-center"><a href="#"><i class="fa fa-facebook"></i></a></div>
                <div class="col-xs-3 col-lg-3 text-center"><a href="#"><i class="fa fa-instagram"></i></a></div>
                <div class="col-xs-3 col-lg-3 text-center"><a href="#"><i class="fa fa-heart"></i></a></div>
            </div>
        </div>
    </div>
    <div class="row about-section text-center">
        <div>
            <div class="col-lg-12">
                <div class="row">
                    <h1><?php echo $user['user_name_first']." ".$user['user_name_last']; ?></h1>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row img-con">
                    <div class="user col-lg-2">
                        <img src='assets/img/73.jpg'/>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row txt-con">
                    <div class="col-lg-6">
                        <p><?php echo $user['user_description']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mt">
                <div class="row font-con">
                    <?php social($user['user_id']); ?>
                </div>
            </div>
        </div>
    </div>
    <h1 class="display-test"></h1>
    <button class="button-test" value="<?php echo $_GET['p']; ?>">Test</button>
    <div class="row direction">
        <div class="col-lg-6">
            <div>
                <div><i class="fa fa-left-arrow"></i></div>
                <div>
                    <span>Previous Post</span>
                    <p>previous post title</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div>
                <div>
                    <span>next Post</span>
                    <p>next post title</p>
                </div>
                <div><i class="fa fa-right-arrow"></i></div>
            </div>
        </div>
    </div>
    <div class="row comment-counts">
        <div class="col-lg-12">
            <p><span><?php echo $blogObj->get_blog_comment_count(); ?></span> Comments</p>
        </div>
    </div>
    <div class="row comments">
        <div class="col-lg-12">
        <?php

            comments($blog_id);
        ?>
    </div>
</section>
