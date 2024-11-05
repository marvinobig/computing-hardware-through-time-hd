<?php

namespace SciMuseum;
class Database {
    protected $connection;
    public function __construct(string $host, string $username, string $password) 
    {
        $this->connection = "$host:$username;$password;";
    }

    public function connectionDetails() :string {
        return $this->connection;
    }
}