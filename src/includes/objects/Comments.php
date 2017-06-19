<?php

class Comments {
    protected $comment_id;
    protected $comment_content;
    protected $user_id;
    protected $comment_time;
    protected $thread_id;
    protected $blog_id;
    protected $comment_replied_to_id;
    protected $comment_replies_count;
    protected $comment_likes_count;
    protected $comment_edited_time;
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    private function check_query($result) {
        if(!$result) {
            die("Query Failed: " . mysqli_error($this->conn));
        }
    }

    public function get_all_comments() {
        $stmt = $this->conn->prepare("SELECT * FROM comments");
        $stmt->execute();
        $result = $stmt->get_result();
        check_query($result);
        return $result;
    }

    public function get_all_comments_sorted($where, $value, $order = "DESC", $column = "comment_time") {
        $columnStr = mysqli_real_escape_string($this->conn, $column);
        $orderStr = mysqli_real_escape_string($this->conn, $order);
        $stmt = $this->conn->prepare("SELECT * FROM comments WHERE {$where}=$value ORDER BY {$columnStr} {$orderStr}");
        $stmt->execute();
        $result = $stmt->get_result();
        check_query($result);
        return $result;
    }



    public function get_comment_replies_count() {
        $stmt = $this->conn->prepare("SELECT comment_replies_count FROM comments WHERE comment_id={$this->comment_id}");
        $stmt->execute();
        $result = $stmt->get_result();
        check_query($result);
        return mysqli_fetch_assoc($result)['comment_replies_count'];
    }

    public function get_comment_likes_count() {
        $stmt = $this->conn->prepare("SELECT comment_likes_count FROM comments WHERE comment_id={$this->comment_id}");
        $stmt->execute();
        $result = $stmt->get_result();
        check_query($result);
        return mysqli_fetch_assoc($result)['comment_likes_count'];
    }

    public function update_comment_likes($add_remove) {
        $a_r;

        switch($add_remove) {
            case "add";
                $a_r = + 1;
            break;
            case "remove";
                $a_r = - 1;
            break;
            default:
                $a_r = + 1;
            break;
        }

        $stmt = $this->conn->prepare("UPDATE comments SET comment_likes_count = comment_likes_count {$a_r} WHERE comment_id={$this->comment_id}");
        $stmt->execute();
        $result = $stmt->get_result();
        check_query($result);
    }

    public function update_replies_count($comment_id, $add_remove) {
        $a_r;

        switch($add_remove) {
            case "add";
                $a_r = + 1;
            break;
            case "remove";
                $a_r = - 1;
            break;
            default:
                $a_r = + 1;
            break;
        }

        $stmt = $this->conn->prepare("UPDATE comments SET comment_replies_count = comment_replies_count {$a_r} WHERE comment_id={$comment_id}");
        $stmt->execute();
        $result = $stmt->get_result();
        check_query($result);
    }

    public function get_all_comments_by_user_id() {
        $query = "SELECT * FROM comments WHERE user_id={$this->user_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return $result;
    }

    public function get_all_comments_by_thread_id() {

    }

    public function get_comment_by_id() {
        $query = "SELECT * FROM comments WHERE blog_id={$this->comment_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return mysqli_fetch_assoc($result);
    }

    public function add_comment() {
        $comment_time = date("Y-m-d H:i:s");
        $query = "INSERT INTO comments(comment_content, user_id, comment_time, thread_id)";
        $query .= "VALUES('{$this->comment_content}', $this->user_id, '{$this->comment_time}', $tis->thread_id)";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
    }

    public function set_id($id) {
        $this->comment_id = mysqli_real_escape_string($this->conn, $id);
    }

    public function set_comment_content($content) {
        $this->comment_content = mysqli_real_escape_string($this->conn, $content);
    }

    public function set_blog($id) {
        $this->blog_id = mysqli_real_escape_string($this->conn, $id);
    }

    public function set_thread($id) {
        $this->thread_id = mysqli_real_escape_string($this->conn, $id);
    }

    public function set_user($id) {
        $this->user_id = mysqli_real_escape_string($this->conn, $id);
    }
}