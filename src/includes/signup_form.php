<?php
    $message = false;
    if(isset($_POST['add_user'])) {
        $user = new Users($connection);
        $user->set_firstname($_POST['user_name_first']);
        $user->set_lastname($_POST['user_name_last']);
        $user->set_email($_POST['user_email']);
        $user->set_username($_POST['user_username']);
        $user->set_password($_POST['user_password']);
        $message = $user->register();
    }
?>

<div class="container signup-section">
    <form action="" method="POST">
    <?php 
        if($message["error"]) {
            echo "<div class='row'>
                    <div class='message col-md-12 text-center'>
                        <p>{$message['message']}</p>
                    </div>
                </div>
                <br/>";
        }
    ?>
        <div class="row">
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
            <div class="form-group col-md-4">
                <label for="password">Username</label>
                <input type="text" name="user_username" placeholder="Username" class="form-control" required>
            </div>
            <div class="form-group col-md-4">
                <label for="password">Password</label>
                <input type="password" name="user_password" placeholder="Password" class="form-control" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <p><button type="submit" class="btn" name="add_user">Sign Up</button></p>
            </div>
        </div>
    </form>
</div>