<?php
class Connection {
    private static $server = "localhost";
    private static $user = "root";
    private static $password = "password";
    private static $db = "bookshop";
    public static $connection;

    private static function createConnection(){
        if (!isset($connection)){
             Connection::$connection = new mysqli(Connection::$server, Connection::$user, Connection::$password, Connection::$db);
            }
    }

    public static function iud($query){
        Connection::createConnection();
        Connection::$connection->query($query);
    }

    public static function select($query){
        Connection::createConnection();
        return Connection::$connection->query($query);
    }

}
?>
