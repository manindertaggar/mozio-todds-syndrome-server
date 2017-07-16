<?php 
namespace Syndrome\utils;

use PDO;
use PDOException;

class Database
{
    static $dbHost  = "localhost";
    static $dbName = "mozio";
    static $dbUserName = "root";
    static $dbPassword = "";
    static $conn;

    public static function init($dbHost, $dbName, $dbUserName, $dbPassword){
        self::$dbHost = $dbHost;
        self::$dbName = $dbName;
        self::$dbUserName = $dbUserName;
        self::$dbPassword = $dbPassword;
    }

    private static function build(){
        self::$conn = new PDO("mysql:host=".self::$dbHost.";dbname=".self::$dbName, self::$dbUserName, self::$dbPassword);
        self::$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function beginTransaction(){
        return   (self::$conn)->beginTransaction();
    }

    public static function rollBack(){
        return (self::$conn)->rollback();
    }

    public static function commit(){
        return (self::$conn)->commit();        
    }

    public static function getConnection(){

        if(self::$conn === null){
            self::build();
        }
        return self::$conn;
    }

    public static function query($sql, $params = null){
        self::build();
        
        $sth = (self::$conn)->prepare($sql);
        if($params === null){
            $sth->execute();
        }else{
            $sth->execute($params);
        }

        return $sth;


    }


}
