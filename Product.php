<?php

namespace EShop;

abstract class Product
{
    const GAIN_PERCENTAGE = 20;
    
    private $basePrice;
    
    public function __construct($basePrice) {
        $this->setBasePrice($basePrice);
    }
    
    public function setBasePrice($basePrice) {
        $this->basePrice = $basePrice;
    }

    public function getBasePrice() {
        return $this->basePrice;
    }
    
    public function calculateGain() {
        return $this->getFinalPrice() * self::GAIN_PERCENTAGE / 100;
    }
    
    abstract function getFinalPrice();
}