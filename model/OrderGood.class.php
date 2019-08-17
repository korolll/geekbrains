<?php

/**
 * Class Order
 * @property string $order_id
 * @property string $good_id
 * @property string $good_number
 */
class OrderGood extends Model {
    protected static $table = 'orders_goods';

    protected static function setProperties()
    {
        self::$properties['order_id'] = [
            'type' => 'int',
        ];

        self::$properties['good_id'] = [
            'type' => 'int',
        ];

        self::$properties['good_number'] = [
            'type' => 'int',
        ];
    }

    public final function create()
    {
        if (!static::tableExists()) {
            throw new Exception('Table ' . static::$table . ' NOT EXISTS');
        }
        try {
            $query = "INSERT INTO " . static::$table . " (`order_id`, `good_id`, `good_number`) VALUES (?, ?, ?);";
            $res = db::getInstance()->Insert($query, [$this->order_id, $this->good_id, $this->good_number]);
        } catch (PDOException $e) {
            return false;
        }

        return $res;
    }
}