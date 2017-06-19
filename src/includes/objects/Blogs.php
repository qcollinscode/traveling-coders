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
    protected $blog_search;
    protected $blog_comments_count;
    protected $category_id;
    protected $blog_image_preview;
    protected $blog_image_01;
    protected $blog_image_02;
    protected $image_upload_dir;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    private function check_query($result) {
        if(!$result) {
            die("Query Failed: " . mysqli_error($this->conn));
        }
    }

    public function get_all_blogs() {
        $query = "SELECT * FROM blogs";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return $result;
    }

    public function get_all_blogs_sorted($column = "blog_time", $order = "DESC") {
        $columnStr = mysqli_real_escape_string($this->conn, $column);
        $orderStr = mysqli_real_escape_string($this->conn, $order);
        $stmt = $this->conn->prepare("SELECT * FROM blogs ORDER BY {$columnStr} {$orderStr}");
        $stmt->execute();
        $result = $stmt->get_result();
        check_query($result);
        return $result;
    }

    public function get_blog_comment_count() {
        $query = "SELECT * FROM comments WHERE blog_id={$this->blog_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        echo mysqli_num_rows($result);
    }

    public function update_blog_views() {
        $query = "UPDATE blogs SET blog_view_count = blog_view_count + 1 WHERE blog_id={$this->blog_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
    }

    public function update_comments_count() {
        $query = "UPDATE blogs SET blog_comments_count = blog_comments_count + 1 WHERE blog_id={$this->blog_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
    }

    public function get_blog_view_count() {
        $query = "SELECT blog_view_count FROM blogs WHERE blog_id={$this->blog_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return mysqli_fetch_assoc($result);
    }

    public function get_all_blogs_by_user_id() {
        $query = "SELECT * FROM blogs WHERE user_id={$this->user_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return $result;
    }

    public function get_all_blogs_by_cat_id() {
        $query = "SELECT * FROM blogs WHERE category_id={$this->category_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return $result;
    }

    public function get_blog_by_id() {
        $query = "SELECT * FROM blogs WHERE blog_id={$this->blog_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return mysqli_fetch_assoc($result);
    }

    public function addBlog() {
        $blog_time = date("Y-m-d H:i:s");
        $query = "INSERT INTO blogs(blog_title, blog_image_preview, category_id, blog_tags, blog_image_01, blog_content_sect_01, blog_content_quote_01, blog_content_sect_02, blog_image_02, blog_content_sect_03, blog_content_quote_02, blog_content_sect_04, blog_time, user_id)";
        $query .= "VALUES('{$this->blog_title}', '{$this->blog_image_preview}', {$this->blog_category}, '{$this->blog_tags}', '{$this->blog_image_01}', '{$this->blog_content_sect_01}', '{$this->blog_content_quote_01}', '{$this->blog_content_sect_02}', '{$this->blog_image_02}', '{$this->blog_content_sect_03}', '{$this->blog_content_quote_02}', '{$this->blog_content_sect_04}', '{$blog_time}', {$this->user_id})";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
    }

    public function upload_blog_image_preview() {
        $tmp_name = $_FILES[$this->blog_image_preview]["tmp_name"];
        $blog_image_preview = basename($_FILES[$this->blog_image_preview]["name"]);
        move_uploaded_file($tmp_name, "$this->image_upload_dir/$blog_image_preview");
    }

    public function upload_blog_image_01() {
        $tmp_name = $_FILES[$this->set_blog_image_01]["tmp_name"];
        $blog_image_preview = basename($_FILES[$this->set_blog_image_01]["name"]);
        move_uploaded_file($tmp_name, "$this->image_upload_dir/$blog_image_preview");
    }

    public function upload_blog_image_02() {
        $tmp_name = $_FILES[$this->set_blog_image_02]["tmp_name"];
        $blog_image_preview = basename($_FILES[$this->set_blog_image_02]["name"]);
        move_uploaded_file($tmp_name, "$this->image_upload_dir/$blog_image_preview");
    }

    public function search_blogs() {
        $stmt = $this->conn->prepare("SELECT * FROM blogs WHERE (blog_tags LIKE '%{$this->blog_search}%')");
        $stmt->execute();
        $result = $stmt->get_result();
        check_query($result);
        return $result;
    }

    public function set_id($id) {
        $this->blog_id = mysqli_real_escape_string($this->conn, $id);
    }

    public function set_user_id($id) {
        $this->user_id = mysqli_real_escape_string($this->conn, $id);
    }

    public function set_search_query($query) {
        $this->blog_search = mysqli_real_escape_string($this->conn, $query);
    }

    public function set_upload_image_dir($dir = '/assets/img') {
        $this->image_upload_dir = getcwd() . mysqli_real_escape_string($this->conn, $dir);
    }

    public function set_time($time) {
        $this->blog_time = mysqli_real_escape_string($this->conn, $time);
    }

    public function set_blog_image_preview_name($image_input_name) {
        $this->blog_image_preview = mysqli_real_escape_string($this->conn, $image_input_name);
    }

    public function set_tags($tags) {
        $this->blog_tags = mysqli_real_escape_string($this->conn, $tags);
    }

    public function set_blog_image_01_name($image_input_name) {
        $this->set_blog_image_01 = mysqli_real_escape_string($this->conn, $image_input_name);
    }

    public function set_blog_image_02_name($image_input_name) {
        $this->set_blog_image_02 = mysqli_real_escape_string($this->conn, $image_input_name);
    }

    public function set_blog_content_quote_01($quote) {
        $this->blog_content_quote_01 = mysqli_real_escape_string($this->conn, $quote);
    }

    public function set_blog_content_quote_02($quote) {
        $this->blog_content_quote_02 = mysqli_real_escape_string($this->conn, $quote);
    }

    public function set_blog_content_sect_01($content) {
        $this->blog_content_sect_01 = mysqli_real_escape_string($this->conn, $content);
    }

    public function set_blog_content_sect_02($content) {
        $this->blog_content_sect_02 = mysqli_real_escape_string($this->conn, $content);
    }

    public function set_blog_content_sect_03($content) {
        $this->blog_content_sect_03 = mysqli_real_escape_string($this->conn, $content);
    }

    public function set_blog_content_sect_04($content) {
        $this->blog_content_sect_04 = mysqli_real_escape_string($this->conn, $content);
    }
}
