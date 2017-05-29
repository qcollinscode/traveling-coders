<?php

class Blogs {
    private $conn;
    protected $blog_id;
    protected $blog_title;
    protected $user_id;
    protected $blog_content_sect_01;
    protected $blog_content_sect_02;
    protected $blog_content_sect_03;
    protected $blog_content_sect_04; 
    protected $blog_content_quote_01;
    protected $blog_content_quote_02;
    protected $blog_tags;
    protected $blog_comments_count;
    protected $category_id;
    protected $blog_image_preview;
    protected $blog_image_01;
    protected $blog_image_02;
    protected $image_upload_dir;

    function __construct($conn) {
        $this->conn = $conn;
    }

    function check_query($result) {
        if(!$result) {
            die("Query Failed: " . mysqli_error($this->conn));
        }
    }

    function get_all_blogs() {
        $query = "SELECT * FROM blogs";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return $result;
    }

    function get_all_blogs_sorted($column = "blog_time", $order = "DESC") {
        $columnStr = mysqli_real_escape_string($this->conn, $column);
        $orderStr = mysqli_real_escape_string($this->conn, $order);
        $query = "SELECT * FROM blogs ORDER BY {$columnStr} {$orderStr}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return $result;
    }

    function get_blog_comment_count() {
        $query = "SELECT blog_comments_count FROM blogs WHERE blog_id={$this->blog_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return mysqli_fetch_assoc($result)['blog_comments_count'];
    }

    function update_blog_views() {
        $query = "UPDATE blogs SET blog_view_count = blog_view_count + 1 WHERE blog_id={$this->blog_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
    }

    function update_comments_count() {
        $query = "UPDATE blogs SET blog_comments_count = blog_comments_count + 1 WHERE blog_id={$this->blog_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
    }

    function get_blog_view_count() {
        $query = "SELECT blog_view_count FROM blogs WHERE blog_id={$this->blog_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return mysqli_fetch_assoc($result);
    }

    function get_all_blogs_by_user_id() {
        $query = "SELECT * FROM blogs WHERE user_id={$this->user_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return $result;
    }

    function get_all_blogs_by_cat_id() {
        $query = "SELECT * FROM blogs WHERE category_id={$this->category_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return $result;
    }

    function get_blog_by_id() {
        $query = "SELECT * FROM blogs WHERE blog_id={$this->blog_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return mysqli_fetch_assoc($result);
    }

    function addBlog() {
        $blog_time = date("Y-m-d H:i:s");
        $query = "INSERT INTO blogs(blog_title, blog_image_preview, category_id, blog_tags, blog_image_01, blog_content_sect_01, blog_content_quote_01, blog_content_sect_02, blog_image_02, blog_content_sect_03, blog_content_quote_02, blog_content_sect_04, blog_time, user_id)";
        $query .= "VALUES('{$this->blog_title}', '{$this->blog_image_preview}', {$this->blog_category}, '{$this->blog_tags}', '{$this->blog_image_01}', '{$this->blog_content_sect_01}', '{$this->blog_content_quote_01}', '{$this->blog_content_sect_02}', '{$this->blog_image_02}', '{$this->blog_content_sect_03}', '{$this->blog_content_quote_02}', '{$this->blog_content_sect_04}', '{$blog_time}', {$this->user_id})";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
    }

    function upload_blog_image_preview($image_src) {
        $tmp_name = $_FILES[$this->blog_image_preview]["tmp_name"];
        $blog_image_preview = basename($_FILES[$this->blog_image_preview]["name"]);
        move_uploaded_file($tmp_name, "$this->image_upload_dir/$blog_image_preview");
    }

    function upload_blog_image_01($image_src) {
        $tmp_name = $_FILES[$this->set_blog_image_01]["tmp_name"];
        $blog_image_preview = basename($_FILES[$this->set_blog_image_01]["name"]);
        move_uploaded_file($tmp_name, "$this->image_upload_dir/$blog_image_preview");
    }

    function upload_blog_image_02($image_src) {
        $tmp_name = $_FILES[$this->set_blog_image_02]["tmp_name"];
        $blog_image_preview = basename($_FILES[$this->set_blog_image_02]["name"]);
        move_uploaded_file($tmp_name, "$this->image_upload_dir/$blog_image_preview");
    }

    function set_id($id) {
        $this->blog_id = $id;
    }

    function set_user_id($id) {
        $this->user_id = $id;
    }

    function set_upload_image_dir($dir = '/assets/img') {
        $this->image_upload_dir = getcwd() . $dir;
    }

    function set_time($time) {
        $this->blog_time = $time;
    }

    function set_blog_image_preview_name($image_input_name) {
        $this->blog_image_preview = $image_input_name;
    }

    function set_tags($tags) {
        $this->blog_tags = $tags;
    }

    function set_blog_image_01_name($image_input_name) {
        $this->set_blog_image_01 = $image_input_name;
    }

    function set_blog_image_02_name($image_input_name) {
        $this->set_blog_image_02 = $image_input_name;
    }

    function set_blog_content_quote_01($quote) {
        $this->blog_content_quote_01 = $quote;
    }

    function set_blog_content_quote_02($quote) {
        $this->blog_content_quote_02 = $quote;
    }

    function set_blog_content_sect_01($content) {
        $this->blog_content_sect_01 = $content;
    }

    function set_blog_content_sect_02($content) {
        $this->blog_content_sect_02 = $content;
    }

    function set_blog_content_sect_03($content) {
        $this->blog_content_sect_03 = $content;
    }

    function set_blog_content_sect_04($content) {
        $this->blog_content_sect_04 = $content;
    }
}



class Threads {
    private $conn;
    protected $thread_id;
    protected $user_id;
    protected $thread_title;
    protected $thread_time;
    protected $thread_tags;
    protected $board_id;
    

    function __construct($conn) {
        $this->conn = $conn;
    }

    function set_id($id) {
        $this->thread_id = $id;
    }

    function set_user_id($id) {
        $this->user_id = $id;
    }

    function set_thread_title($title) {
        $this->thread_title = $title;
    }

    function set_time($time) {
        $this->thread_time = $time;
    }

    function set_tags($tags) {
        $this->thread_tags = $tags;
    }

    function get_all_threads() {
        $query = "SELECT * FROM threads";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return $result;
    }

    function get_all_threads_sorted($column = "thread_time", $order = "DESC") {
        $columnStr = mysqli_real_escape_string($this->conn, $column);
        $orderStr = mysqli_real_escape_string($this->conn, $order);
        $query = "SELECT * FROM threads ORDER BY {$columnStr} {$orderStr}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return $result;
    }

    function get_all_threads_by_user_id() {
        $query = "SELECT * FROM threads WHERE user_id={$this->user_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return $result;
    }

    function get_thread_by_id() {
        $query = "SELECT * FROM threads WHERE thread_id={$this->thread_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return $result;
    }

    function get_thread_by_board_id() {
        $query = "SELECT * FROM threads WHERE board_id={$this->board_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return $result;
    }

    function add_thread() {
        $blog_time = date("Y-m-d H:i:s");
        $query = "INSERT INTO threads(thread_title, thread_tags, board_id, user_id, thread_time)";
        $query .= "VALUES('{$this->thread_title}', '{$this->thread_tags}', {$this->board_id}, {$this->user_id}, '{$this->thread_time}')";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
    }

    function update_likes_count() {
        $query = "UPDATE threads SET thread_likes_count = thread_likes_count + 1 WHERE thread_id={$this->thread_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
    }

    function update_comments_count() {
        $query = "UPDATE threads SET thread_comments_count = thread_comments_count + 1 WHERE thread_id={$this->thread_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
    }

    function update_views_count() {
        $query = "UPDATE threads SET thread_views_count = thread_views_count + 1 WHERE thread_id={$this->thread_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
    }

}

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

    function __construct($conn) {
        $this->conn = $conn;
    }

    function set_id($id) {
        $this->user_id = $id;
    }

    function set_title($title) {
        $this->user_title = $title;
    }

    function set_firstname($name) {
        $this->user_name_first = $name;
    }

    function set_lastname($name) {
        $this->user_name_last = $name;
    }

    function set_username($username) {
        $this->user_username = $username;
    }

    function set_email($email) {
        $this->user_email = $email;
    }

    function add_user() {
        $query = "INSERT INTO users(user_name_first, user_name_last, user_password, user_email, user_username)";
        $query .= "VALUES('{$this->user_name_first}', '{$this->user_name_last}', '{$this->user_password}', '{$this->user_email}', '{$this->user_username}')";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
    }

    function get_all_users() {
        $query = "SELECT * FROM users";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return $result;
    }

    function get_user_by_id($userId = "") {
        $userId = $userId === "" ? $this->user_id : $userId;
        $userIdNum = mysqli_real_escape_string($this->conn, $userId);
        $query = "SELECT * FROM users WHERE user_id={$userIdNum}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return mysqli_fetch_assoc($result);
    }

}