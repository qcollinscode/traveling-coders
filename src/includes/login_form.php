<?php
    $message = false;
    if(isset($_POST['login'])) {
        $user_username = mysqli_real_escape_string($connection, $_POST['user_username']);
        $user_password = mysqli_real_escape_string($connection, $_POST['user_password']);
        $query = "SELECT * FROM users WHERE user_username='{$user_username}'";
        $result = mysqli_query($connection, $query);
        check_query($result);

        if(mysqli_num_rows($result) >= 1) {
            $user = mysqli_query($connection, $query);
            check_query($connection, $query);
            $row = mysqli_fetch_assoc($user);
            $db_password = $row['user_password'];
            $db_username = $row['user_username'];

            if($db_password === $user_password) {
                 $_SESSION['userId'] = getIdByUsername($db_username);
                 $cookie_name = "username";
                 $cookie_value = $db_username;
                 setcookie($cookie_name, $cookie_value, time() + ( 86400 * 30 ), "/");
                 header("Location: index.php");
            } else {
                $message = "Wrong password!!!!";
            }
        } else {
            $message = "Username does not exist!!!";
        }     
    }
?>

<div class="container login-section">
    <form action="" method="POST">
        <?php 
            if($message != false) {
                echo "<div class='row'><div class='message col-md-12 text-center'><p>{$message}</p></div></div><br/>";
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