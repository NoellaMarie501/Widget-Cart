<?php

namespace App;

class PricingRule {
    private array $rules = [];

    public function __construct(array $rules) {
        $this->rules = $rules;
    }

    public function getPrice(string $productCode): float {
        return $this->rules[$productCode] ?? 0.0;
    }
}
