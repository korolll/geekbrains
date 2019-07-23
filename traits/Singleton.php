<?php

namespace EShop\Traits;


trait Singleton {
    private static $product;
    
    public static function getInstance($basePrice){
        if (self::$product == null) {
            self::$product = new self($basePrice);
        }
        
        return self::$product;
    }
}