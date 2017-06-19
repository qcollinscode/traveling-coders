<?php

class Boards {
    protected $board_id;
    protected $board_title;
    protected $board_post_count;
    protected $board_users_count;
    protected $category_id;
    protected $board_date;
    protected $board_views_count;
    protected $board_open;
    protected $user_id;
    private $conn;

    public function set_id($id) {
        $this->board_id = mysqli_real_escape_string($this->conn, $id);
    }

    public function set_title($title) {
        $this->board_title = mysqli_real_escape_string($this->conn, $title);
    }

    public function set_category($category) {
        $this->category_id = mysqli_real_escape_string($this->conn, $category);
    }

    public function set_date($date) {
        $this->board_date = mysqli_real_escape_string($this->conn, $date);
    }

    public function set_open($active) {
        $this->board_open = mysqli_real_escape_string($this->conn, $active);
    }

    public function set_user($userId) {
        $this->user_id = mysqli_real_escape_string($this->conn, $userId);
    }

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function add_board() {
        $query = "INSERT INTO boards(board_title, category_id, board_date, user_id)";
        $query .= "VALUES('{$this->board_id}', '{$this->category_id}', '{$this->board_date}', '{$this->user_id}')";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
    }

    public function get_all_boards() {
        $query = "SELECT * FROM boards";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return $result;
    }

    public function get_all_board_threads() {
        $query = "SELECT * FROM threads WHERE board_id={$this->board_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return $result;
    }

    public function get_all_board_threads_sorted($column = "thread_time", $order = "DESC") {
        $columnStr = mysqli_real_escape_string($this->conn, $column);
        $orderStr = mysqli_real_escape_string($this->conn, $order);
        $query = "SELECT * FROM threads WHERE board_id={$this->board_id} ORDER BY {$columnStr} {$orderStr}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return $result;
    }

    public function get_board_category() {
        $query = "SELECT * FROM categories WHERE category_id={$this->category_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return mysqli_fetch_assoc($result);
    }

    public function get_board_thread_count() {
        $query = "SELECT * FROM threads WHERE board_id={$this->board_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return mysqli_num_rows($result);
    }

}