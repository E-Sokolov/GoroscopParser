<?php
class DB
{

    public static function getConnect()
    {
        $paramsPath = './core/config.php';
        $params = include($paramsPath);
        $dsn = "mysql:host={$params['DBhost']};dbname={$params['DBname']}";
        $db = new PDO($dsn, $params['DBuser'], $params['DBpassword']);
        print_r($db -> errorInfo());
        $db->exec("set names utf8");

        return $db;
    }

}

