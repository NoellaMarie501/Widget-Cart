<?php
namespace App\Offers;

interface OfferInterface {
    public function apply(array $products, float $subtotal): float;
}
