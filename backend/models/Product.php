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

    // Create Prduct
    public function create()
    {
        $query = 'INSERT INTO ' .
            $this->table . '
            SET
                sku = :sku,
                name = :name,
                price = :price,
                attribute = :attribute,
                value = :value';

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->sku = htmlspecialchars(strip_tags($this->sku));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->attribute = htmlspecialchars(strip_tags($this->attribute));
        $this->value = htmlspecialchars(strip_tags($this->value));

        // bind data
        $stmt->bindParam(':sku', $this->sku);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':attribute', $this->attribute);
        $stmt->bindParam(':value', $this->value);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        // print error if something goes wrong
        printf('Error: %s.\n', $stmt->error);

        return false;
    }
}
