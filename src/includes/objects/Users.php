<?php

class Users {
    private $conn;
    protected $user_id;
    protected $user_name_first;
    protected $user_name_last;
    protected $user_password;
    protected $user_avatar;
    protected $user_username;
    protected $user_email;
    protected $user_title;
    protected static $username_max_len = 12;
    protected $user_description;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    protected function error_message($message) {
        return array("error" => true, "message" => $message);
    }

    public function check_username_exists($username) {
        $username = mysqli_real_escape_string($this->conn, $username);
        $query = "SELECT * FROM users WHERE user_username='{$username}'";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        $user = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) >= 1 && ucfirst($user["user_username"]) == ucfirst($username)) {
            return array("exists" => true, "user" => $user);
        } else {
            return array("exists" => false);
        }
    }

    protected function validate_username_len() {
        if(strlen($this->user_username) < 12) {
            return true;
        } else {
            return false;
        }
    }

    public function login() {
        $user_arr = $this->check_username_exists($this->user_username);
        if ($user_arr["exists"]) {
            $user = $user_arr['user']; 
            $db_password = $user['user_password'];
            $db_username = $user['user_username'];
            if($db_password == $this->user_password) {
                 $_SESSION['userId'] = $user['user_id'];
                 $cookie_name = "username";
                 $cookie_value = $db_username;
                 setcookie($cookie_name, $cookie_value, time() + ( 86400 * 30 ), "/");
                 header("Location: index.php");
            } else {
                return $this->error_message("Username or password is incorrect!!");
            }
        } else {
            return $this->error_message("Username or password is incorrect!!");
        }

    }

    public function register() {
        if($this->validate_username_len()) {
            if(!$this->check_username_exists($this->user_username)["exists"]) {
                $query = "INSERT INTO users(user_name_first, user_name_last, user_password, user_email, user_username)";
                $query .= "VALUES('{$this->user_name_first}', '{$this->user_name_last}', '{$this->user_password}', '{$this->user_email}', '{$this->user_username}')";
                $result = mysqli_query($this->conn, $query);
                check_query($result);
                header("Location: /sw.php?p=login");
            } else {
                return $this->error_message("Username already exist!!!");
            }
        } else {
            return $this->error_message("Username must be less than 12 characters.");
        }

    }

    public function get_all_users() {
        $query = "SELECT * FROM users";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return $result;
    }

    public function get_user_by_username() {
        $query = "SELECT * FROM users WHERE user_username='{$this->user_username}'";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return $result;
    }

    public function get_user_by_id($userId = "") {
        $userId = $userId === "" ? $this->user_id : $userId;
        $userIdNum = mysqli_real_escape_string($this->conn, $userId);
        $query = "SELECT * FROM users WHERE user_id={$userIdNum}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return mysqli_fetch_assoc($result);
    }

    public function set_id($id) {
        $this->user_id = mysqli_real_escape_string($this->conn, $id);
    }

    public function set_title($title) {
        $this->user_title = mysqli_real_escape_string($this->conn, $title);
    }

    public function set_firstname($name) {
        $this->user_name_first = mysqli_real_escape_string($this->conn, $name);;
    }

    public function set_lastname($name) {
        $this->user_name_last = mysqli_real_escape_string($this->conn, $name);;
    }

    public function set_description($description) {
        $this->user_description = mysqli_real_escape_string($this->conn, $description);
    }

    public function set_username($username) {
        $this->user_username = mysqli_real_escape_string($this->conn, $username);
    }

    public function set_password($password) {
        $this->user_password = mysqli_real_escape_string($this->conn, $password);
    }

    public function set_email($email) {
        $this->user_email = mysqli_real_escape_string($this->conn, $email);
    }

}