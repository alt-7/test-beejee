<?php
/**
 * @package Chocolife.me
 * @author  Altynbek <akhmedov.a@chocolife.kz>
 */

namespace application\models\orm;
use application\lib\ActiveRecord;
use application\lib\Db;

abstract class Base extends ActiveRecord
{
    abstract protected static function getTableName(): string;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public static function findAll(): array
    {
        return Db::getInstance()->query('SELECT * FROM `'.static::getTableName().'`;', [], static::class);
    }

    /**
     * @param array  $params
     * @param string $condition
     * @param null   $sort
     * @param null   $limit
     * @param null   $offset
     * @return array|null
     */
    public static function findBy($params = [], $condition = 'AND', $sort = null, $limit = null, $offset = null)
    {
        $sql = static::getSelectCondition($params, $condition);
        if (!is_null($sort) && is_array($sort)) {
            foreach ($sort as $key => $val) {
                $sql .= ' ORDER BY '.$key .' '. $val;
            }
        }
        if(!is_null($offset)) {
            $sql .= ' LIMIT '.$offset;
        }
        if(!is_null($limit)) {
            $sql .= ', '.$limit;
        }

        $entities = Db::getInstance()->query($sql, $params, static::class);
        return $entities;
    }

    /**
     * @param array  $params
     * @param string $condition
     * @return null
     */
    public static function findOneBy(array $params = [], $condition = 'AND')
    {
        $sql = static::getSelectCondition($params, $condition);
        $entities = Db::getInstance()->query($sql, $params, static::class);
        return $entities ? $entities[0] : null;
    }

    /**
     * @param int $id
     * @return Base|null
     */
    public static function getById(int $id): ?self
    {
        $entities = Db::getInstance()->query(
            'SELECT * FROM `'.static::getTableName().'` WHERE id=:id;',
            [':id' => $id],
            static::class
        );
        return $entities ? $entities[0] : null;
    }

    /**
     * @param array $params
     * @param       $condition
     * @return string
     */
    private static function getSelectCondition(array $params, $condition)
    {
        $conditions = [];
        $sql = 'SELECT * FROM `'.static::getTableName().'`';
        if (!empty($params)) {
            $sql .= ' WHERE ';
            foreach ($params as $key => $val) {
                $conditions[] = sprintf('%s=:%s', $key, $key);
            }
        }
        $sql .= implode(' '.$condition.' ', $conditions);
        return $sql;
    }
}
