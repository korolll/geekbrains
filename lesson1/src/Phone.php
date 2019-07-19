<?php

class Phone
{
    private $brand;
    private $model;
    private $price;
    private $color;
    private $availability;

    public function __construct($brand, $model, $price, $color, $availability)
    {
        $this->setBrand($brand);
        $this->setModel($model);
        $this->setPrice($price);
        $this->setColor($color);
        $this->setAvailability($availability);
    }

    public function getBrand() {
        return $this->brand;
    }

    public function getModel() {
        return $this->model;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getColor() {
        return $this->color;
    }

    public function getAvailability() {
        return $this->availability;
    }

    public function setBrand($brand) {
        $this->brand = $brand;
    }

    public function setModel($model) {
        $this->model = $model;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function setAvailability($availability) {
        $this->availability = $availability;
    }

    public function calcWithDiscount($discount) {
        echo $this->getBrand() . ' ' . $this->getModel() . ' со скидкой всего за ' . $this->getPrice() * (100 - $discount) / 100;
        echo '<br>';
        if ($this->getAvailability() == true) {
            echo 'Есть в наличии';
        } else {
            echo 'Под заказ';
        }
    }
}

$phone = new Phone('Nokia', '3310', '1000', 'purple', true);
$phone->calcWithDiscount(5);