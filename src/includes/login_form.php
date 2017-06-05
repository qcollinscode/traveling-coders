<?php
    $message = false;
    $user = new Users($connection);
    if(isset($_POST['login'])) {
        $user->set_username($_POST['user_username']);
        $user->set_password($_POST['user_password']);
        $message = $user->login();
    }
?>

<div class="container login-section">
    <form action="" method="POST">
        <?php 
            if($message["error"]) {
                echo "<div class='row'>
                        <div class='message col-md-12 text-center'>
                            <p>{$message["message"]}</p>
                        </div>
                    </div>
                    <br/>";
            }
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="username">Username</label>
                        <input type="text" name="user_username" placeholder="Username" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="username">Password</label>
                        <input type="password" name="user_password" placeholder="Password" class="form-control" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <p><button type="submit" class="btn" name="login">Log In</button></p>
                    </div>
                    <div class="col-md-6 signup-container">
                        <p><a href='sw.php?p=signup'><i class='fa fa-sign-in'></i>Sign Up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>