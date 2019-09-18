<?php
    // db class
    class database {
        // db params
        private $server = 'localhost';
        private $db_name = 'my_db';
        private $user = 'root';
        private $pass = '';
        private $conn;
    
        // db connection
        public function connect() {
            $this->conn = null;
    
            try {
                $this->conn = new PDO('mysql:host=' .$this->server. ';dbname=' .$this->db_name, $this->user, $this->pass);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo 'Connection Error: '.$e->getMessage();
            }
    
            return $this->conn;
        }
    }