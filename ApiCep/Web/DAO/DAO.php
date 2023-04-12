<?php

namespace App\DAO;

use \PDO;

use Exception;
use PDOException;

abstract class DAO extends PDO
{
    protected $conexao;

    protected function __construct()
    {
        try
        {
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES uft8"
            ];
            
            $dsn = "mysql:host=" . $_ENV["dv"]["host"] . ";dbname=" . $_ENV["db"]["database"];
            
            $this->conexao = new PDO($dsn, $_ENV["db"]["user"], $_ENV["db"]["pass"], $options);
        }
        catch (PDOException $e)
        {
            throw new Exception("Ocorreu um erro ao tentar conectar ao MySql", 0, $e);
        }
    }
}