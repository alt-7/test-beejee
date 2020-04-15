<?php
/**
 * @package Chocolife.me
 * @author  Altynbek <akhmedov.a@chocolife.kz>
 */

namespace application\lib;

use application\core\Model;

class ActiveRecord extends Model
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var array
     */
    protected $fields = [];

    /**
     * @var array
     */
    protected $properties = [];

    public function __set($name, $value)
    {
        $this->properties[$name] = $value;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->fields)) {
            return $this->properties[$name];
        }
    }

    public function save(): void
    {
        $mappedProperties = $this->mapPropertiesToDbFormat();
        if ($this->id !== null) {
            $this->update($mappedProperties);
        } else {
            $this->insert($mappedProperties);
        }
    }

    private function mapPropertiesToDbFormat(): array
    {
        $reflector = new \ReflectionObject($this);
        $properties = $reflector->getProperties();

        $mappedProperties = [];
        foreach ($properties as $property) {
            $propertyName = $property->getName();
            $mappedProperties[$propertyName] = $this->$propertyName;
        }
        unset($mappedProperties['db']);
        unset($mappedProperties['properties']);
        return array_filter($mappedProperties);
    }

    private function update(array $mappedProperties): void
    {
        $params = [];
        $values = [];
        foreach ($mappedProperties as $column => $value) {
            $params[] = $column . '=:' . $column;
            $values[$column] = $value;
        }
        $sql = 'UPDATE ' . static::getTableName() . ' SET ' . implode(', ', $params) . ' WHERE id = ' . $this->id;
        $this->db->query($sql, $values, static::class);
    }

    private function insert(array $mappedProperties): void
    {
        $columns = [];
        $paramsNames = [];
        $params2values = [];
        foreach ($mappedProperties as $columnName => $value) {
            $columns[] = '`' . $columnName. '`';
            $paramName = ':' . $columnName;
            $paramsNames[] = $paramName;
            $params2values[$paramName] = $value;
        }

        $columnsViaSemicolon = implode(', ', $columns);
        $paramsNamesViaSemicolon = implode(', ', $paramsNames);

        $sql = 'INSERT INTO ' . static::getTableName() . ' (' . $columnsViaSemicolon . ') VALUES (' . $paramsNamesViaSemicolon . ');';
        $this->db->query($sql, $params2values, static::class);
    }

}
