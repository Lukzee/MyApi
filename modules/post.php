<?php
class post {
    // db stuff
    private $conn;
    private $table = 'table1';

    //post propts
    public $id;
    public $category;
    public $post;

    // construct with db
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // get posts
    public function read() {
        // create query
        $ql = 'SELECT * FROM ' .$this->table. ' ORDER BY id DESC';

        // prepare statmnt
        $stmt = $this->conn->prepare($ql);

        // exec query
        $stmt->execute();

        return $stmt;
    }

    // get single post
    public function read_single() {
        // Create query
        $ql = 'SELECT * FROM ' .$this->table. ' WHERE id = ? LIMIT 0,1';

        // preapare statement
        $stmt = $this->conn->prepare($ql);

        // Bind ID
        $stmt->bindParam(1, $this->id);

        // exec query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //set properties
        $this->id = $row['id'];
        $this->category = $row['category'];
        $this->post = $row['post'];
    }

    // create post
    public function create() {
        // create query
        $ql = 'INSERT INTO ' . $this->table . '
        SET
            category = :category,
            post = :post';

        // prepare statement
        $stmt = $this->conn->prepare($ql);

        // clean data
        $this->category = htmlspecialchars(htmlentities(strip_tags($this->category)));
        $this->post = htmlspecialchars(htmlentities(strip_tags($this->post)));

        // bind data
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':post', $this->post);

        // exec query
        if($stmt->execute()) {
            return true;
        }

        // print error
        printf('Error: %s.\n', $stmt->error);

        return false;
    }

    // Update post
    public function update() {
        // create query
        $ql = 'UPDATE ' . 
                $this->table . '
            SET
                category = :category,
                post = :post
            WHERE
            id = :id';

        // prepare statement
        $stmt = $this->conn->prepare($ql);

        // clean data
        $this->category = htmlspecialchars(htmlentities(strip_tags($this->category)));
        $this->post = htmlspecialchars(htmlentities(strip_tags($this->post)));
        $this->id = htmlspecialchars(htmlentities(strip_tags($this->id)));

        // bind data
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':post', $this->post);
        $stmt->bindParam(':id', $this->id);

        // exec query
        if($stmt->execute()) {
            return true;
        }

        // print error
        printf('Error: %s.\n', $stmt->error);

        return false;
    }

    // Delete post
    public function delete() {
        // create query
        $ql = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        // prepare statement
        $stmt = $this->conn->prepare($ql);

        // clean data
        $this->id = htmlspecialchars(htmlentities(strip_tags($this->id)));

        // bind data
        $stmt->bindParam(':id', $this->id);

        // execute query
        if($stmt->execute()) {
            return true;
        }

        // print error
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

}