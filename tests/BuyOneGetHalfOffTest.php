<?php
use PHPUnit\Framework\TestCase;
use App\Offers\BuyOneGetHalfOff;
use App\Product;

class BuyOneGetHalfOffTest extends TestCase
{
    public function testApplyWithNoRedWidgets()
    {
        $offer = new BuyOneGetHalfOff();
        $products = [
            new Product('B01', 'B01', 10.00),
            new Product('G01', 'G01', 15.00),
        ];
        $subtotal = 25.00;

        $result = $offer->apply($products, $subtotal);

        $this->assertEquals(25.00, $result);
    }

    public function testApplyWithOneRedWidget()
    {
        $offer = new BuyOneGetHalfOff();
        $products = [
            new Product('R01', 'R01', 32.95),
        ];
        $subtotal = 32.95;

        $result = $offer->apply($products, $subtotal);

        $this->assertEquals(32.95, $result);
    }

    public function testApplyWithTwoRedWidgets()
    {
        $offer = new BuyOneGetHalfOff();
        $products = [
            new Product('R01', 'R01',32.95),
            new Product('R01','R01',32.95)
        ];
        $subtotal = 65.90;

        $result = $offer->apply($products, $subtotal);

        $this->assertEquals(49.42, $result);
    }

    public function testApplyWithThreeRedWidgets()
    {
        $offer = new BuyOneGetHalfOff();
        $products = [
            new Product('R01', 'R01', 32.95),
            new Product('R01', 'R01', 32.95),
            new Product('R01', 'R01', 32.95),
        ];
        $subtotal = 98.85;

        $result = $offer->apply($products, $subtotal);

        $this->assertEquals(82.37, $result);
    }

    public function testApplyWithFourRedWidgets()
    {
        $offer = new BuyOneGetHalfOff();
        $products = [
            new Product('R01', 'R01', 32.95),
            new Product('R01', 'R01', 32.95),
            new Product('R01', 'R01', 32.95),
            new Product('R01', 'R01', 32.95),
        ];
        $subtotal = 131.80;

        $result = $offer->apply($products, $subtotal);

        $this->assertEquals(115.32, $result);
    }
}