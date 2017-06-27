<?php
    include "includes/header.php";
    $user = $_GET['user'];
    $usersObj = new Users($connection);
    $usersObj->set_username($user);
    $user = mysqli_fetch_assoc($usersObj->get_user_by_username());
    $fullUserName = ucwords($user['user_name_first'])." ".ucwords($user['user_name_last']);
?>

<div class="profile container-fluid">
    <div class="header row"></div>
    <div class="content row">
        <div class="col-sm-4 user-info">
            <div class="avatar row">
                <div class="img col-sm-12" style="background-image:url('assets/img/73.jpg')"></div>
            </div>
            <div class="name row">
                <span class="col-sm-12"><?php echo $fullUserName; ?></span>
            </div>
            <div class="title row">
                <span class="col-sm-12"><?php echo $user['user_title']; ?></span>
            </div>
            <div class="email row">
                <span class="col-sm-12"><?php echo $user['user_email'];?></span>
            </div>
            <div class="fol row">
                <div class="following">
                    <span class="num"><?php echo $user['following_num'];?></span>
                    <p>Following</p>
                </div>
                <div class="followers">
                    <span class="num"><?php echo $user['followers_num'];?></span>
                    <p>Followers</p>
                </div>
            </div>
            <hr />
            <div class="description row">
                <div class="col-sm-12">
                    <p><?php echo $user['user_description'];?></p>
                </div>
            </div>
            <hr />
            <div class="buttons row">
                <button class="btn follow-btn">Follow <i class="fa fa-user-plus"></i></button>
                <button class="btn message-btn">Message <i class="fa fa-envelope"></i></button>
            </div>
        </div>
        <div class="col-sm-8 user-content">
            <div class="tabs">
                <span class="blogs-tab selected">Blogs</span>
                <span class="threads-tab">Threads</span>
                <span class="comments-tab">Comments</span>
            </div>
            <div class="user-content-container">
                <div class="blogs">
                    <div class="container-fluid">
                        <div class="row">
                            <?php
                            
                            for($i = 0; $i < 8; $i++) {

                            ?>
                            <div class="col-lg-4">
                                <div class="blog">
                                    <div class="img"></div>
                                    <div class="text">
                                        <h4>What is your favorite color? What is your favorite color? What is your favorite color?</h4>
                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>
                <div class="threads">
                    <div class="container-fluid">
                        <ul class="threads-list">
                            <?php for($i = 0; $i < 6; $i++) {?>
                                <li class="threads-list-item col-sm-12">
                                    <div class="thread-title">
                                        <h3>Best beach in Germany?</h3>
                                    </div>
                                    <div class="last-comment_time">
                                        <h3>Latest Comment</h3>
                                        <p>Hi</p>
                                        <p><span>2 days ago</span> by <span> George</span></p>
                                    </div>
                                    <div class="thread-created">
                                        <h3>Thread Created</h3>
                                        <p><span>2 days ago</span> by <span> Admin</span></p>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="comments">
                    <div class="container-fluid">
                        <p>Hello</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/main.js" type="application/javascript"></script>