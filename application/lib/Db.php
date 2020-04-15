<?php

namespace application\lib;

use PDO;

class Db
{
    private static $instance;

    private $db;

    private function __construct()
    {
        $config = require 'application/config/db.php';
        try {
            $this->db =
                new PDO('mysql:host='.$config['host'].';dbname='.$config['name'].'', $config['user'],
                    $config['password']);
        } catch (\PDOException $e) {
            throw new \Exception('Ошибка при подключении к базе данных: '.$e->getMessage());
        }
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Выполнение запроса
     * @param string $sql
     * @param array  $params
     * @param string $className
     * @return array|null
     */
    public function query(string $sql, array $params = [], string $className = ''): ?array
    {
        $stmt = $this->db->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                if (is_int($val)) {
                    $type = PDO::PARAM_INT;
                } else {
                    $type = PDO::PARAM_STR;
                }
                $stmt->bindValue(':'.$key, $val, $type);
            }
        }
        $result = $stmt->execute($params);
        if (false === $result) {
            return null;
        }
        if(!empty($className)) {
            return $stmt->fetchAll(\PDO::FETCH_CLASS, $className);
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function select(string $sql, array $params = [])
    {
        $entities = Db::getInstance()->query($sql, $params);
        return $entities;
    }

    /**
     * Возвращает last id
     * @return string
     */
    public function lastInsertId()
    {
        return $this->db->lastInsertId();
    }
}
