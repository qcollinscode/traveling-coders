<?php

class Threads {
    private $conn;
    protected $thread_id;
    protected $user_id;
    protected $thread_title;
    protected $thread_tags;
    protected $comment_content;
    protected $board_id;
    

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function set_id($id) {
        $this->thread_id = mysqli_real_escape_string($this->conn, $id);
    }

    public function set_user_id($id) {
        $this->user_id = mysqli_real_escape_string($this->conn, $id);
    }

    public function set_thread_title($title) {
        $this->thread_title = mysqli_real_escape_string($this->conn, $title);
    }

    public function set_time($time) {
        $this->thread_time = mysqli_real_escape_string($this->conn, $time);
    }

    public function set_tags($tags) {
        $this->thread_tags = mysqli_real_escape_string($this->conn, $tags);
    }

    public function set_board($boardId) {
        $this->board_id = mysqli_real_escape_string($this->conn, $boardId);
    }

    public function set_comment_content($content) {
        $this->comment_content = mysqli_real_escape_string($this->conn, $content);
    }


    public function get_all_threads() {
        $query = "SELECT * FROM threads";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return $result;
    }

    public function get_thread_comments_count() {
        $query = "SELECT * FROM comments WHERE thread_id={$this->thread_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return mysqli_num_rows($result);
    }

    public function get_all_thread_comments_sorted($order = "DESC") {
        $orderStr = mysqli_real_escape_string($this->conn, $order);
        $query = "SELECT * FROM comments WHERE thread_id={$this->thread_id} ORDER BY comment_time {$orderStr}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return $result;
    }

    public function get_all_threads_sorted($column = "thread_time", $order = "DESC") {
        $columnStr = mysqli_real_escape_string($this->conn, $column);
        $orderStr = mysqli_real_escape_string($this->conn, $order);
        $query = "SELECT * FROM threads ORDER BY {$columnStr} {$orderStr}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return $result;
    }

    public function get_all_threads_by_user_id() {
        $query = "SELECT * FROM threads WHERE user_id={$this->user_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return $result;
    }

    public function get_thread_by_id() {
        $query = "SELECT * FROM threads WHERE thread_id={$this->thread_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return mysqli_fetch_assoc($result);
    }

    public function get_thread_by_board_id() {
        $query = "SELECT * FROM threads WHERE board_id={$this->board_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return $result;
    }

    public function get_thread_by_board_id_sorted($column = "thread_time", $order = "DESC") {
        $columnStr = mysqli_real_escape_string($this->conn, $column);
        $orderStr = mysqli_real_escape_string($this->conn, $order);
        $query = "SELECT * FROM threads WHERE board_id={$this->board_id} ORDER BY {$columnStr} {$orderStr}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return mysqli_fetch_assoc($result);
    }

    public function add_thread() {
        $time = date("Y-m-d H:i:s");
        $query = "INSERT INTO threads(thread_title, thread_tags, board_id, user_id, thread_time)";
        $query .= "VALUES('{$this->thread_title}', '{$this->thread_tags}', {$this->board_id}, {$this->user_id}, '{$time}')";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
    }

    public function add_comment() {
        $time = date("Y-m-d H:i:s");
        $query = "INSERT INTO comments(comment_content, user_id, comment_time, thread_id)";
        $query .= "VALUES('{$this->comment_content}', $this->user_id, '{$time}', $this->thread_id)";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
    }

    public function update_likes_count() {
        $query = "UPDATE threads SET thread_likes_count = thread_likes_count + 1 WHERE thread_id={$this->thread_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
    }

    public function update_comments_count() {
        $query = "UPDATE threads SET thread_comments_count = thread_comments_count + 1 WHERE thread_id={$this->thread_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
    }

    public function update_views_count() {
        $query = "UPDATE threads SET thread_views_count = thread_views_count + 1 WHERE thread_id={$this->thread_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
    }

}