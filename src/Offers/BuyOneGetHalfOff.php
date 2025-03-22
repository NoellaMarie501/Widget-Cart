<?php

namespace App\Offers;

class BuyOneGetHalfOff implements OfferInterface
{
    public function apply(array $products, float $subtotal): float
    {
        $redWidgets = array_values(array_filter($products, fn($p) => $p->code === 'R01'));
        $redWidgetCount = count($redWidgets);

        $discount = 0;
        if ($redWidgetCount > 1) {
            $discount = $redWidgets[0]->price / 2;
        }

        return floor(($subtotal - $discount) * 100) / 100;
    }
}
