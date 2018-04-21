<?php

namespace app\system;

use \PDO, \PDOException, \PDOStatement;

class DBController
{
    private $link;

    public function __construct()
    {
        try {
            $dsn = "mysql:host=localhost;port=3306;dbname=lb_local;charset=utf8";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ];
            $this->link = new PDO($dsn, 'root', '', $options);
        } catch (PDOException $e) {
            die("Произошла ошибка при подключении. Попробуйте снова через пару минут.");
        }
    }

    public function query($sql, array $args = array()): PDOStatement
    {
        try {
            $query = $this->link->prepare($sql);
            $query->execute($args);
            return $query;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

}