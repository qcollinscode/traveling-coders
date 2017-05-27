<?php
    include "includes/header.php";
    $blog_id = $_GET['p'];
    $blogData = getById("blogs", "blog_id", $blog_id);
    $blog = mysqli_fetch_assoc($blogData);
    $userData = getById("users", "user_id", $blog['user_id']);
    $user = mysqli_fetch_assoc($userData);
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
                        <p>About Arthur</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mt">
                <div class="row font-con">
                    <div class="col-lg-1"><a href="#"><i class="fa fa-twitter"></i></a></div>
                    <div class="col-lg-1"><a href="#"><i class="fa fa-facebook"></i></a></div>
                    <div class="col-lg-1"><a href="#"><i class="fa fa-instagram"></i></a></div>
                    <div class="col-lg-1"><a href="#"><i class="fa fa-heart"></i></a></div>
                </div>
            </div>
        </div>
    </div>
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
            <p><span>12</span> Comments</p>
        </div>
    </div>
    <div class="row comments">
        <div class="col-lg-12">
            <div class="comment">
                <h1>JOHN DOE</h1>
                <p class="date"><span>August 5, 2016</span></p>
                <span class="ln"></span>
                <p class="comment-comment">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis saepe iste iure labore cum temporibus eveniet nisi provident, accusamus ab non ullam quae rem, maiores voluptatibus. Facilis doloribus, ipsa repellendus.</p>
                <button>reply</button>
            </div>
            <div class="sub">
                <div class="comment">
                    <h1>JOHN DOE</h1>
                    <p class="date"><span>August 5, 2016</span></p>
                    <span class="ln"></span>
                    <p class="comment-comment">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis saepe iste iure labore cum temporibus eveniet nisi provident, accusamus ab non ullam quae rem, maiores voluptatibus. Facilis doloribus, ipsa repellendus.</p>
                    <button>reply</button>
                </div>
                <div class="comment">
                    <h1>JOHN DOE</h1>
                    <p class="date"><span>August 5, 2016</span></p>
                    <span class="ln"></span>
                    <p class="comment-comment">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis saepe iste iure labore cum temporibus eveniet nisi provident, accusamus ab non ullam quae rem, maiores voluptatibus. Facilis doloribus, ipsa repellendus.</p>
                    <button>reply</button>
                </div>
                <div class="sub">
                    <div class="comment">
                        <h1>JOHN DOE</h1>
                        <p class="date"><span>August 5, 2016</span></p>
                        <span class="ln"></span>
                        <p class="comment-comment">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis saepe iste iure labore cum temporibus eveniet nisi provident, accusamus ab non ullam quae rem, maiores voluptatibus. Facilis doloribus, ipsa repellendus.</p>
                        <button>reply</button>
                    </div>
                    <div class="comment">
                        <h1>JOHN DOE</h1>
                        <p class="date"><span>August 5, 2016</span></p>
                        <span class="ln"></span>
                        <p class="comment-comment">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis saepe iste iure labore cum temporibus eveniet nisi provident, accusamus ab non ullam quae rem, maiores voluptatibus. Facilis doloribus, ipsa repellendus.</p>
                        <button>reply</button>
                    </div>
                    <div class="sub">
                        <div class="comment">
                            <h1>JOHN DOE</h1>
                            <p class="date"><span>August 5, 2016</span></p>
                            <span class="ln"></span>
                            <p class="comment-comment">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis saepe iste iure labore cum temporibus eveniet nisi provident, accusamus ab non ullam quae rem, maiores voluptatibus. Facilis doloribus, ipsa repellendus.</p>
                            <button>reply</button>
                        </div>
                        <div class="comment">
                            <h1>JOHN DOE</h1>
                            <p class="date"><span>August 5, 2016</span></p>
                            <span class="ln"></span>
                            <p class="comment-comment">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis saepe iste iure labore cum temporibus eveniet nisi provident, accusamus ab non ullam quae rem, maiores voluptatibus. Facilis doloribus, ipsa repellendus.</p>
                            <button>reply</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row comments">
        <div class="col-lg-12">
            <div class="comment">
                <h1>JOHN DOE</h1>
                <p class="date"><span>August 5, 2016</span></p>
                <span class="ln"></span>
                <p class="comment-comment">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis saepe iste iure labore cum temporibus eveniet nisi provident, accusamus ab non ullam quae rem, maiores voluptatibus. Facilis doloribus, ipsa repellendus.</p>
                <button>reply</button>
            </div>
            <div class="sub">
                <div class="comment">
                    <h1>JOHN DOE</h1>
                    <p class="date"><span>August 5, 2016</span></p>
                    <span class="ln"></span>
                    <p class="comment-comment">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis saepe iste iure labore cum temporibus eveniet nisi provident, accusamus ab non ullam quae rem, maiores voluptatibus. Facilis doloribus, ipsa repellendus.</p>
                    <button>reply</button>
                </div>
                <div class="comment">
                    <h1>JOHN DOE</h1>
                    <p class="date"><span>August 5, 2016</span></p>
                    <span class="ln"></span>
                    <p class="comment-comment">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis saepe iste iure labore cum temporibus eveniet nisi provident, accusamus ab non ullam quae rem, maiores voluptatibus. Facilis doloribus, ipsa repellendus.</p>
                    <button>reply</button>
                </div>
                <div class="sub">
                    <div class="comment">
                        <h1>JOHN DOE</h1>
                        <p class="date"><span>August 5, 2016</span></p>
                        <span class="ln"></span>
                        <p class="comment-comment">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis saepe iste iure labore cum temporibus eveniet nisi provident, accusamus ab non ullam quae rem, maiores voluptatibus. Facilis doloribus, ipsa repellendus.</p>
                        <button>reply</button>
                    </div>
                    <div class="comment">
                        <h1>JOHN DOE</h1>
                        <p class="date"><span>August 5, 2016</span></p>
                        <span class="ln"></span>
                        <p class="comment-comment">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis saepe iste iure labore cum temporibus eveniet nisi provident, accusamus ab non ullam quae rem, maiores voluptatibus. Facilis doloribus, ipsa repellendus.</p>
                        <button>reply</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row leave-reply">
        <div class="col-lg-12">
            <div>
                <h1>Leave a reply</h1>
                <p>Your email address will not be published. Required fields.</p>
                <form action="#" method="#" class="row">
                    <div class="form-input col-lg-12">
                        <label for="comment-box">Comment</label>
                        <textarea name="comment-box" type="textarea"></textarea>
                    </div>
                    <div class="form-input col-lg-3">
                        <label for="name">Name</label>
                        <input type="text" name="name">
                    </div>
                    <div class="form-input col-lg-3">
                        <label for="name">Email</label>
                        <input type="email" name="email">
                    </div>
                    <div class="form-input col-lg-3">
                        <label for="website">Website</label>
                        <input type="text" name="website">
                    </div>
                    <div class="col-lg-3 text-center">
                        <button type="submit" style="">Post comment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
    include "includes/footer.php";
?>
