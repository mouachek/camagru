<?php

require_once("./config/setup.php");

class DB
{
    protected static $instance;
    protected function __construct()
    {
    }
    public static function getInstance()
    {
        if (empty(self::$instance)) {
            $db_info = array(
                "db_host" => DB_HOST,
                "db_port" => DB_PORT,
                "db_user" => DB_USER,
                "db_pass" => DB_PASS,
                "db_name" => DB_DATABASE,
                "db_charset" => DB_CHARSET
            );
            try {
                self::$instance = new PDO("mysql:host=".$db_info['db_host'].';port='.$db_info['db_port'].';', $db_info['db_user'], $db_info['db_pass']);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
                self::$instance->query('SET NAMES utf8');
                self::$instance->query('SET CHARACTER SET utf8');
                self::$instance->exec(
                    "SET NAMES 'utf8';
					SET character_set_connection=utf8;
					SET character_set_client=utf8;
					SET character_set_results=utf8"
                );
                configDatabase();
            } catch (PDOException $error) {
                echo $error->getMessage();
            }
        }
        return self::$instance;
    }
}
