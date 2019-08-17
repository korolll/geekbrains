<?php

/**
 * Class Order
 * @property string $user_id
 * @property string $order_id
 * @property string $status
 */
class Order extends Model {

    protected static $table = 'orders';

    protected static function setProperties()
    {
        self::$properties['user_id'] = [
            'type' => 'int'
        ];

        self::$properties['status'] = [
            'type' => 'int'
        ];
    }

    public final function create()
    {
        if (!static::tableExists()) {
            throw new Exception('Table ' . static::$table . ' NOT EXISTS');
        }
        try {
            $query = "INSERT INTO " . static::$table . " (`user_id`, `status`) VALUES (?, ?);";
            $res = db::getInstance()->Insert($query, [$this->user_id, OrderStatus::Active]);
        } catch (PDOException $e) {
            return false;
        }

        return $res;
    }
}