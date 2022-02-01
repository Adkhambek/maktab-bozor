<?php
require_once '../include/config.php';
class Database
{
    public $db;
    private $dbHost = DB_HOST;
    private $dbUsername = DB_USER;
    private $dbPassword = DB_PASS;
    private $dbName = DB_NAME;

    public function __construct()
    {
        if (!isset($this->db)) {
            // Connect to the database
            try {
                $conn = new PDO("mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName.";charset=utf8mb4", $this->dbUsername, $this->dbPassword);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->db = $conn;
            } catch (PDOException $e) {
                die("Failed to connect with MySQL: " . $e->getMessage());
            }
        }
    }

}
