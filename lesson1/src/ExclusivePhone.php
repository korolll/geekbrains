<?php
include 'Phone.php';

class ExclusivePhone extends Phone
{
    public $material;

    public function __construct($brand, $model, $price, $color, $availability, $material)
    {
        parent::__construct($brand, $model, $price, $color, $availability);
        $this->setMaterial($material);
    }

    public function getMaterial() {
        return $this->material;
    }

    public function setMaterial($material) {
        $this->material = $material;
    }

    public function calcWithDiscount($discount) {
        parent::calcWithDiscount($discount);
        echo '<br>';
        echo 'Выполнен из высококачественного материала: ' . $this->getMaterial() . '<br>';
    }
}