<?php
    $login_message = false;
    $signup_message = false;
    $user = new Users($connection);

    if(isset($_POST['login'])) {
        $user->set_username($_POST['user_username']);
        $user->set_password($_POST['user_password']);
        $login_message = $user->login();
    }
    if(isset($_POST['add_user'])) {
        $user->set_firstname($_POST['user_name_first']);
        $user->set_lastname($_POST['user_name_last']);
        $user->set_email($_POST['user_email']);
        $user->set_username($_POST['user_username']);
        $user->set_password($_POST['user_password']);
        $signup_message = $user->register();
    }
?>

<div class="container-fluid login-signup-section">
    <div class="login-signup-container">
        <div class="container login-signup">
            <div class="login-signup-buttons row">
                <div class="col-xs-6 col-sm-6 login login-signup-selected">
                    <p>Login</p>
                </div>
                <div class="col-xs-6 col-sm-6 signup">
                    <p>Signup</p>
                </div>
            </div>
            <div class="login-form-container">
                <form action="" method="POST">
                    <div class="form-group col-md-12">
                        <label for="username">Username</label>
                        <input type="text" name="user_username" placeholder="Username" class="form-control" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="username">Password</label>
                        <input type="password" name="user_password" placeholder="Password" class="form-control" required>
                    </div>
                    <?php 
                        if($login_message["error"]) {
                            echo "<div class='row'>
                                    <div class='message col-md-12 text-center'>
                                        <p>{$login_message["message"]}</p>
                                    </div>
                                </div>
                                <br/>";
                        }
                    ?>
                    <button type="submit" class="btn" name="login">Log In</button>
                </form>
            </div>
            <div class="signup-form-container">
                <form action="" method="POST">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="username">Name</label>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" name="user_name_first" placeholder="First" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" name="user_name_last" placeholder="Last" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-xs-12">
                        <label for="password">Email</label>
                        <input type="email" name="user_email" placeholder="Email" class="form-control" required>
                    </div>
                    <div class="form-group col-xs-12">
                        <label for="password">Username</label>
                        <input type="text" name="user_username" placeholder="Username" class="form-control" required>
                    </div>
                    <div class="form-group col-xs-12">
                        <label for="password">Password</label>
                        <input type="password" name="user_password" placeholder="Password" class="form-control" required>
                    </div>
                    <?php 
                        if($signup_message["error"]) {
                            echo "<div class='row'>
                                    <div class='message col-md-12 text-center'>
                                        <p>{$signup_message["message"]}</p>
                                    </div>
                                </div>
                                <br/>";
                        }
                    ?>
                    <button type="submit" class="btn" name="add_user">Sign Up</button>
                </form>
            </div>
        </div>
    </div>
</div>