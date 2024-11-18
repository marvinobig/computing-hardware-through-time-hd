<?php

class Database
{
    private $connection;
    private $query;

    public function __construct(string $dbType, string $host, int $port, string $dbName, string $username, string $password)
    {
        try {
            $this->connection = new PDO("{$dbType}:host={$host};port={$port};dbname={$dbName}", $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo 'Connection Successful';
        } catch (PDOException $err) {
            echo "Connection Failed: {$err->getMessage()}";
        }

    }
}