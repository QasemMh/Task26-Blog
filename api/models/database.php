<?php


class Database
{
    protected $conn = null;

    public function __construct()
    {
        try {
            $this->conn = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" .  DB_DATABASE_NAME,
                DB_USERNAME,
                DB_PASSWORD
            );
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            new PDOException("Connection error: " . $exception->getMessage());
        }
    }
}
