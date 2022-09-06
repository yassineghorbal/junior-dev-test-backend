<?php
class Database
{
    private $conn;

    // DB Connection
    public function connect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:dbname=junior-dev-test;host=127.0.0.1', 'root', '');
            $this->conn->setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection error: ' . $e->getMessage();
        }

        return $this->conn;
    }
}
