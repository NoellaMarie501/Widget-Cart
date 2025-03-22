<?php
namespace App\Delivery;

interface DeliveryRuleInterface {
    public function calculate(float $subtotal): float;
}
