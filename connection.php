<?php

class Connection
{
    private static $pdo;

    public static function getConnection()
    {
        if(empty(self::$pdo))
        {
            try
            {  
                self::$pdo = new PDO("mysql:dbname=crud;host=localhost", "root", "");
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $ex)
            {
                die('oops');
            }
        }

        return self::$pdo;

    }
}