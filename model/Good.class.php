<?php

class Good extends Model {
    protected static $table = 'goods';

    protected static function setProperties()
    {
        self::$properties['name'] = [
            'type' => 'varchar',
            'size' => 512
        ];

        self::$properties['price'] = [
            'type' => 'float'
        ];

        self::$properties['description'] = [
            'type' => 'text'
        ];

        self::$properties['category'] = [
            'type' => 'int'
        ];
    }

    public static function getGoods($categoryId = null)
    {
        $query = 'SELECT * FROM goods WHERE status=:status';
        $params = [
            ':status' => Status::Active
        ];
        if ($categoryId) {
            $categoriesQuery = "SELECT id_category FROM categories WHERE id_category=$categoryId OR parent_id = $categoryId";
            $categories = db::getInstance()->Select($categoriesQuery);
            $arr = [];
            foreach ($categories as $category) {
                $arr[] = $category['id_category'];
            }
            $str =implode(',', $arr);
            $query .= " AND (id_category IN ($str))";
        }
        return db::getInstance()->Select($query, $params);
    }

    public static function getGood($goodId)
    {
        $query = 'SELECT * FROM goods WHERE id_good=:id';
        $params = [
            ':id' => $goodId
        ];
        return db::getInstance()->SingleSelect($query, $params);
    }
}