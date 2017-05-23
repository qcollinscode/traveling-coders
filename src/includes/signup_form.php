<?php
    if(isset($_POST['add_user'])) {
        $user_name_first = mysqli_real_escape_string($connection, $_POST['user_name_first']);
        $user_name_last = mysqli_real_escape_string($connection, $_POST['user_name_last']);
        $user_password = mysqli_real_escape_string($connection, $_POST['user_password']);
        $user_email = mysqli_real_escape_string($connection, $_POST['user_email']);
        $user_username = mysqli_real_escape_string($connection, $_POST['user_username']);

        $query = "INSERT INTO users(user_name_first, user_name_last, user_password, user_email, user_username)";
        $query .= "VALUES('{$user_name_first}', '{$user_name_last}', '{$user_password}', '{$user_email}', '{$user_username}')";
        $insert_user = mysqli_query($connection, $query);

        check_query($insert_user);
        header("Location: /sw.php?p=login");
    }
?>

<div class="container signup-section">
    <form action="" method="POST">
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
            <div class="form-group col-md-4">
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