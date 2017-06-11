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
        $query = "SELECT * FROM comments";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return $result;
    }

    public function get_all_comments_sorted($where, $value, $order = "DESC", $column = "comment_time") {
        $columnStr = mysqli_real_escape_string($this->conn, $column);
        $orderStr = mysqli_real_escape_string($this->conn, $order);
        $query = "SELECT * FROM comments WHERE {$where}=$value ORDER BY {$columnStr} {$orderStr}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return $result;
    }



    public function get_comment_replies_count() {
        $query = "SELECT comment_replies_count FROM comments WHERE comment_id={$this->comment_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return mysqli_fetch_assoc($result)['comment_replies_count'];
    }

    public function get_comment_likes_count() {
        $query = "SELECT comment_likes_count FROM comments WHERE comment_id={$this->comment_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return mysqli_fetch_assoc($result)['comment_likes_count'];
    }

    public function update_comment_likes($comment_id, $add_remove) {
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

        $query = "UPDATE comments SET comment_likes_count = comment_likes_count {$a_r} WHERE comment_id={$comment_id}";
        $result = mysqli_query($this->conn, $query);
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

        $query = "UPDATE comments SET comment_replies_count = comment_replies_count {$a_r} WHERE comment_id={$comment_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
    }

    public function get_all_comments_by_user_id() {
        $query = "SELECT * FROM comments WHERE user_id={$this->user_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return $result;
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
        $this->comment_id = $id;
    }

    public function set_comment_content($content) {
        $this->comment_content = $content;
    }

    public function set_blog($id) {
        $this->blog_id = $id;
    }

    public function set_user($id) {
        $this->user_id = $id;
    }
}

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
        $query = "SELECT * FROM blogs ORDER BY {$columnStr} {$orderStr}";
        $result = mysqli_query($this->conn, $query);
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

    public function upload_blog_image_preview($image_src) {
        $tmp_name = $_FILES[$this->blog_image_preview]["tmp_name"];
        $blog_image_preview = basename($_FILES[$this->blog_image_preview]["name"]);
        move_uploaded_file($tmp_name, "$this->image_upload_dir/$blog_image_preview");
    }

    public function upload_blog_image_01($image_src) {
        $tmp_name = $_FILES[$this->set_blog_image_01]["tmp_name"];
        $blog_image_preview = basename($_FILES[$this->set_blog_image_01]["name"]);
        move_uploaded_file($tmp_name, "$this->image_upload_dir/$blog_image_preview");
    }

    public function upload_blog_image_02($image_src) {
        $tmp_name = $_FILES[$this->set_blog_image_02]["tmp_name"];
        $blog_image_preview = basename($_FILES[$this->set_blog_image_02]["name"]);
        move_uploaded_file($tmp_name, "$this->image_upload_dir/$blog_image_preview");
    }

    public function set_id($id) {
        $this->blog_id = $id;
    }

    public function set_user_id($id) {
        $this->user_id = $id;
    }

    public function set_upload_image_dir($dir = '/assets/img') {
        $this->image_upload_dir = getcwd() . $dir;
    }

    public function set_time($time) {
        $this->blog_time = $time;
    }

    public function set_blog_image_preview_name($image_input_name) {
        $this->blog_image_preview = $image_input_name;
    }

    public function set_tags($tags) {
        $this->blog_tags = $tags;
    }

    public function set_blog_image_01_name($image_input_name) {
        $this->set_blog_image_01 = $image_input_name;
    }

    public function set_blog_image_02_name($image_input_name) {
        $this->set_blog_image_02 = $image_input_name;
    }

    public function set_blog_content_quote_01($quote) {
        $this->blog_content_quote_01 = $quote;
    }

    public function set_blog_content_quote_02($quote) {
        $this->blog_content_quote_02 = $quote;
    }

    public function set_blog_content_sect_01($content) {
        $this->blog_content_sect_01 = $content;
    }

    public function set_blog_content_sect_02($content) {
        $this->blog_content_sect_02 = $content;
    }

    public function set_blog_content_sect_03($content) {
        $this->blog_content_sect_03 = $content;
    }

    public function set_blog_content_sect_04($content) {
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
        $this->thread_tags = mysqli_real_escape_string($this->conn, $boardId);
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
        return $result;
    }

    public function get_thread_by_board_id() {
        $query = "SELECT * FROM threads WHERE board_id={$this->board_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return $result;
    }

    public function add_thread() {
        $blog_time = date("Y-m-d H:i:s");
        $query = "INSERT INTO threads(thread_title, thread_tags, board_id, user_id, thread_time)";
        $query .= "VALUES('{$this->thread_title}', '{$this->thread_tags}', {$this->board_id}, {$this->user_id}, '{$this->thread_time}')";
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
                return $this->error_message("Wrong Password!!!");
            }
        } else {
            return $this->error_message("Username doesn't exist!!!");
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

class Favorites {
    protected $favorite_id;
    protected $user_id;
    protected $blog_id;
    protected $comment_id;
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function set_id($id) {
        $this->favorite_id = $id;
    }

    public function set_user($id) {
        $this->user_id = $id;
    }

    public function set_blog($id) {
        $this->blog_id = $id;
    }

    public function set_comment($id) {
        $this->comment_id = $id;
    }

    public function add_favorite() {
        $query = "INSERT INTO favorites(user_id, blog_id, comment_id) ";
        $query .= "VALUES('{$this->user_id}', '{$this->blog_id}', '{$this->comment_id}')";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
    }

    public function remove_favorite() {
        $query = "DELETE FROM favorites WHERE user_id={$this->user_id} AND blog_id={$this->blog_id}";
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

class Categories {
    protected $category_name;
    protected $category_id;
    private $conn;

    public function set_name($name) {
        $this->category_name = $name;
    }

    public function set_id($id) {
        $this->category_id = $id;
    }

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function add_category() {
        $query = "INSERT INTO categories(category_name) ";
        $query .= "VALUES('{$this->category_name}')";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
    }

    public function get_categories() {
        $query = "SELECT * FROM categories";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
    }

    public function get_category_by_id() {
        $query = "SELECT * FROM categories WHERE category_id={$this->category_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return mysqli_fetch_assoc($result);
    }

}

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