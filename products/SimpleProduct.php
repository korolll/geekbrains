<?php

namespace EShop\Products;

use EShop\Product;
use EShop\Traits\Singleton;

class SimpleProduct extends Product {
    use Singleton;

    public function getFinalPrice() {
        return $this->getBasePrice();
    }
}