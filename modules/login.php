<?php

class login {
    // db stuff
    private $conn;
    private $table = 'reg';

    //login propts
    public $user;
    public $pass;

    // construct with db
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // get posts
    public function login_user() {
        // create query
        $ql = 'SELECT
            id,
            user,
            pass
        FROM 
            ' .$this->table. ' 
        WHERE
            user = :user
        AND 
            pass = :pass';

        // prepare statmnt
        $stmt = $this->conn->prepare($ql);

        // clean data
        $this->user = htmlspecialchars(htmlentities(strip_tags($this->user)));
        $this->pass = htmlspecialchars(htmlentities(strip_tags($this->pass)));

        // bind data
        $stmt->bindParam(':user', $this->user);
        $stmt->bindParam(':pass', $this->pass);

        // exec query
        if($stmt->execute()){
            return true;
        }

        // error
        printf('Error: %s.\n', $stmt->error);
        return false;
    }
}