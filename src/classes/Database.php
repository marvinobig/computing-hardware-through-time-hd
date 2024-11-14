<?php

class Database {
    protected $connection;
    public function __construct(PDO $pdo) 
    {
        try {
            $this->connection = $pdo;
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo 'Connection Successful';
        } catch (PDOException $err) {
            echo "Connection Failed: {$err->getMessage()}";
        }
    }
}