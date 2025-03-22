<?php

namespace App;

use App\Delivery\DeliveryRuleInterface;
use App\Offers\OfferInterface;

class Basket {
    private array $products = [];
    private PricingRule $pricingRule;
    private DeliveryRuleInterface $deliveryRule;
    private array $offers;

    public function __construct(PricingRule $pricingRule, DeliveryRuleInterface $deliveryRule, array $offers = []) {
        $this->pricingRule = $pricingRule;
        $this->deliveryRule = $deliveryRule;
        $this->offers = $offers;
    }

    public function add(string $productCode): void {
        $price = $this->pricingRule->getPrice($productCode);
        if ($price == 0.0) {
            throw new \Exception("Product not found in catalog");
        }
        $this->products[] = new Product($productCode, $productCode, $price);
    }

    public function total(): float {
        $subtotal = 0;

        /** @var Product $product */
        foreach ($this->products as $product) {
            $subtotal += $product->price;
        }
        /**
         * @var OfferInterface $offer
         */
        foreach ($this->offers as $offer) {
            $subtotal = $offer->apply($this->products, $subtotal);
        }
        
        $deliveryCost = $this->deliveryRule->calculate($subtotal);

        //rounding value to get the significant numbers
        return floor(($subtotal + $deliveryCost) * 100) / 100;
    }
}
