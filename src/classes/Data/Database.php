<?php

namespace Data;

use PDO;
use PDOException;
use Exception;
use App\Utilities;

class Database
{
    private $connection;
    private $query;

    public function __construct(string $dbType, string $host, int $port, string $dbName, string $username, string $password)
    {
        try {
            $this->connection = new PDO("{$dbType}:host={$host};port={$port};dbname={$dbName};charset=utf8mb4", $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $err) {
            echo "Connection Failed: {$err->getMessage()}";
        }

    }

    public function createTables(string $sqlFile): void
    {
        try {
            $sqlScriptFile = "./src/db/{$sqlFile}";

            if (!file_exists($sqlScriptFile)) {
                throw new Exception("SQL file doesn't exist");
            }

            $query = file_get_contents($sqlScriptFile);

            $this->connection->exec($query);
        } catch (Exception $err) {
            echo "Error: {$err->getMessage()}";
        }
    }

    public function query(string $sqlStatement, array|null $executeValues = null, string $errFormat = 'echo'): array|int
    {
        try {
            $executedStatement = $this->connection->prepare($sqlStatement);

            if ($executeValues) {
                $executedStatement->execute($executeValues);
            } else {
                $executedStatement->execute();
            }

            if (stripos($sqlStatement, 'SELECT') === 0) {
                return $executedStatement->fetchAll();
            }

            return $executedStatement->rowCount();
        } catch (PDOException $err) {
            switch ($errFormat) {
                case 'json':
                    Utilities::sendJson(400, ['msg' => "Query Error: {$err->getMessage()}"]);
                    break;

                default:
                    echo "Query Error: {$err->getMessage()}";
                    break;
            }

            return [];
        } catch (Exception $err) {
            echo "Error: {$err->getMessage()}";
            return [];
        }
    }

    public function createAdmin(string $username, string $password): void
    {
        try {
            $userExists = $this->connection->prepare('SELECT * FROM admin_users WHERE username = ?');
            $userExists->execute([$username]);

            if ($userExists->rowCount() < 1) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $executedStatement = $this->connection->prepare('INSERT INTO admin_users (username, password_hash) VALUES (?, ?)');

                $executedStatement->execute([$username, $hashedPassword]);
            } 
        } catch (PDOException $err) {
            echo "Query Error: {$err->getMessage()}";
        } catch (Exception $err) {
            echo "Error: {$err->getMessage()}";
        }
    }
}