<?php

class Category extends Model
{
    protected static $table = 'categories';

    protected static function setProperties()
    {
        self::$properties['name'] = [
            'type' => 'varchar',
            'size' => 512
        ];

        self::$properties['parent_id'] = [
            'type' => 'int',
        ];
    }

    public static function getCategories($parentId = 0)
    {
        $data =  db::getInstance()->Select(
            'SELECT * FROM categories WHERE status=:status',
            ['status' => Status::Active]
        );
        $tree = [];
        self::makeTree( $data, 0, $tree );

        return $tree;
    }

    private static function makeTree( $data, $level, &$tree )
    {
        for ( $i=0, $n=count($data); $i < $n; $i++ )
        {
            if ( $data[$i]['parent_id'] == $level )
            {
                $branch = array(
                    'id' => $data[$i]['id_category'],
                    'name' => $data[$i]['name'],
                    'children' => []
                );
                self::makeTree( $data, $data[$i]['id_category'], $branch['children'] );
                $tree[] = $branch;
            }
        }
        return $tree;
    }
}