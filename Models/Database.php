<?php

class Database
{
    // Store the single instance of Database connection
    private static $connection = null;

    // Database credentials
    private static $host = 'localhost';
    private static $username = 'root';
    private static $password = '';
    private static $database = 'tempahan_kenderaan'; // replace with your actual database name

    // Private constructor to prevent direct object creation
    private function __construct() {}

    // Method to get the database connection
    public static function getConnection()
    {
        // If connection is not already created, create one
        if (self::$connection === null) {
            self::$connection = new mysqli(self::$host, self::$username, self::$password, self::$database);

            // Check connection
            if (self::$connection->connect_error) {
                die("Connection failed: " . self::$connection->connect_error);
            }
        }

        return self::$connection;
    }

    // Prevent cloning the object
    private function __clone() {}

    // Close the connection when the script ends
    public function __destruct()
    {
        if (self::$connection) {
            self::$connection->close();
        }
    }
}

