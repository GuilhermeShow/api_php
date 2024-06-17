<?php 

abstract class Connect {

    private static $host = HOST;
    private static $dbname = DBNAME;
    private static $username = USERNAME;
    private static $password = PASSWORD;
    private static $conn;

    protected static function connect() {
        self::$conn = new PDO("mysql:host=".self::$host.";dbname=".self::$dbname, self::$username, self::$password);
        return self::$conn;
    }

}

?>