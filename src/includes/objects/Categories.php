<?php

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
        return $result;
    }

    public function get_category_by_id() {
        $query = "SELECT * FROM categories WHERE category_id={$this->category_id}";
        $result = mysqli_query($this->conn, $query);
        check_query($result);
        return mysqli_fetch_assoc($result);
    }

}