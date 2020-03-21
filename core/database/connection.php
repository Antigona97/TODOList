<?php

namespace App\Core\Database;

use PDO;
use PDOException;


class connection
{
    public static function connect($config){
        try{
            return new PDO (
                $config['connection'].';dbname='.$config['name'],
                $config['username'],
                $config['password'],
                $config['options']
            );
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
}