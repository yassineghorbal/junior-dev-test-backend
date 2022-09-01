<?php

class Product
{
    //DB
    private $conn;
    private $table = 'products';

    //Product properties
    public $id;
    public $sku;
    public $name;
    public $price;
    public $attribute;
    public $value;

    //Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get Products
    public function read()
    {
        // create query
        $query = 'SELECT * FROM ' . $this->table . ' ORDER BY created_at DESC';

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}
