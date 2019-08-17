<?php

/**
 * Class User
 * @property string $name
 * @property string $password
 */
class User extends Model
{
    protected static $table = 'user';

    protected static function setProperties()
    {
        self::$properties['name'] = [
            'type' => 'varchar',
            'size' => 50
        ];

        self::$properties['password'] = [
            'type' => 'varchar',
            'size' => 512
        ];
    }

    public final function create()
    {
        if (!static::tableExists()) {
            throw new Exception('Table ' . static::$table . ' NOT EXISTS');
        }
        try {
            $query = "INSERT INTO " . static::$table . " (`name`, `password`) VALUES (?, ?);";
            db::getInstance()->Query($query, [$this->name, $this->password]);
        } catch (PDOException $e) {
            return false;
        }

        return true;
    }

    public final function login()
    {
        try {
            $query = "SELECT * FROM `" . static::$table . "` WHERE name = ? AND password = ?;";
            $result = db::getInstance()->SingleSelect($query, [$this->name, $this->password]);
        } catch (PDOException $e) {
            return false;
        }

        return $result;
    }
}