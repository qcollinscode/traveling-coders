<?php

    class database {
        // private $host = "us-cdbr-iron-east-03.cleardb.net";
        // private $user = "b221ad66af70e8";
        // private $password = "295a8efe";
        // private $db = "heroku_0b0118ba54f5bdc";

        private $host = "localhost";
        private $user = "root";
        private $password = "";
        private $db = "traveling_coders";
        private $conn;

        function connect() {
            $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->db);
            if(!$this->conn) die('Connection Failed');
            return $this->conn;
        }
    }

    $database = new database();
    $connection = $database->connect();