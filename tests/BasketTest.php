<?php

use PHPUnit\Framework\TestCase;
use App\Basket;
use App\Delivery\StandardDelivery;
use App\Offers\BuyOneGetHalfOff;
use App\PricingRule;

class BasketTest extends TestCase
{
    private PricingRule $pricingRule;
    private StandardDelivery $deliveryRule;
    private array $offers;

    protected function setUp(): void
    {
        $this->pricingRule = new PricingRule([
            'B01' => 7.95,
            'G01' => 24.95,
            'R01' => 32.95,
        ]);

        $this->deliveryRule = new StandardDelivery();
        $this->offers = [new BuyOneGetHalfOff()];
    }

    /**
     * @dataProvider basketProvider
     */
    public function testBasketTotal(array $productCodes, float $expectedTotal)
    {
        $basket = new Basket($this->pricingRule, $this->deliveryRule, $this->offers);

        foreach ($productCodes as $code) {
            $basket->add($code);
        }

        $calculatedTotal = $basket->total();
        $this->assertEquals(
            $expectedTotal,
            $calculatedTotal,
            "Failed for products: " . implode(', ', $productCodes)
        );
    }

    public static function basketProvider(): array
    {
        return [
            [['B01', 'G01'], 37.85],
            [['R01', 'R01'], 54.37],
            [['R01', 'G01'], 60.85],
            [['B01', 'B01', 'R01', 'R01', 'R01'], 98.27],
        ];
    }
}
