<?php

class Favorites {
    protected $favorite_id;
    protected $user_id;
    protected $blog_id;
    protected $thread_id;
    protected $comment_id;
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function set_id($id) {
        $this->favorite_id = mysqli_real_escape_string($this->conn, $id);
    }

    public function set_user($id) {
        $this->user_id = mysqli_real_escape_string($this->conn, $id);
    }

    public function set_blog($id) {
        $this->blog_id = mysqli_real_escape_string($this->conn, $id);
    }

    public function set_comment($id) {
        $this->comment_id = mysqli_real_escape_string($this->conn, $id);
    }

    public function set_thread($id) {
        $this->thread_id = mysqli_real_escape_string($this->conn, $id);
    }

    public function add_blog_comment_favorite() {
        $query = "INSERT INTO favorites(user_id, blog_id, comment_id) ";
        $query .= "VALUES('{$this->user_id}', '{$this->blog_id}', '{$this->comment_id}')";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
    }


    public function add_comment_favorite() {
        $query = "INSERT INTO favorites(user_id, comment_id) ";
        $query .= "VALUES('{$this->user_id}', '{$this->comment_id}')";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
    }


    public function remove_favorite() {
        $query = "DELETE FROM favorites WHERE user_id={$this->user_id} AND comment_id={$this->comment_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
    }

    public function get_favorite_by_blog_user_id() {
        $query = "SELECT * FROM favorites WHERE blog_id={$this->blog_id} AND user_id={$this->user_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return $result;
    }

    public function get_all_favorites() {
        $query = "SELECT * FROM favorites";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return $result;
    }

}