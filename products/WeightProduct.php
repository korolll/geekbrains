<?php

namespace EShop\Products;

use EShop\Product;
use EShop\Traits\Singleton;

class WeightProduct extends Product {
    use Singleton;
    
    private $weight;
    
    public function setWeight($weight) {
        $this->weight = $weight;
    }
    
    public function getFinalPrice() {
        if (!$this->weight) {
            echo 'Set weight, please..';
            return;
        }
    
        return $this->getBasePrice() * $this->weight;
    }
}