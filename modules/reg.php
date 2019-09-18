<?php
    class reg_User {
        // db stuff
        private $conn;
        private $reg_Table = 'Registration';

        //reg propts
        public $fName;
        public $lName;
        public $userName;
        public $password;

        // construct with db
        public function __construct($db)
        {
            $this->conn = $db;
        }

        // register user
        public function Register() {
            // create query
            $ql = 'INSERT INTO ' . $this->reg_Table . '
            SET
                fName = :fName,
                lName = :lName,
                userName = :userName,
                password = :password';

            // prepare statement
            $stmt = $this->conn->prepare($ql);

            // clean data
            $this->fName = htmlspecialchars(htmlentities(strip_tags($this->fName)));
            $this->lName = htmlspecialchars(htmlentities(strip_tags($this->lName)));
            $this->userName = htmlspecialchars(htmlentities(strip_tags($this->userName)));
            $this->password = htmlspecialchars(htmlentities(strip_tags($this->password)));

            // bind data
            $stmt->bindParam('fName', $this->fName);
            $stmt->bindParam('lName', $this->lName);
            $stmt->bindParam('userName', $this->userName);
            $stmt->bindParam('password', $this->password);

            // exec query
            if($stmt->execute()) {
                return true;
            }

            // print error
            printf('Error: %s.\n', $stmt->error);

            return false;
        }
    }